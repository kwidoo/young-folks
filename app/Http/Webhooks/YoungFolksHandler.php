<?php

namespace App\Http\Webhooks;

use App\Models\MenuItem;
use App\Models\Type;
use DefStudio\Telegraph\DTO\CallbackQuery;
use DefStudio\Telegraph\DTO\Chat;
use DefStudio\Telegraph\DTO\InlineQuery;
use DefStudio\Telegraph\DTO\Message;
use DefStudio\Telegraph\DTO\User;
use DefStudio\Telegraph\Exceptions\TelegramWebhookException;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use DefStudio\Telegraph\Models\TelegraphBot;
use DefStudio\Telegraph\Models\TelegraphChat;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class YoungFolksHandler
{
    protected TelegraphBot $bot;
    protected TelegraphChat $chat;

    protected int $messageId;
    protected int $callbackQueryId;

    protected Request $request;
    protected Message|null $message = null;
    protected CallbackQuery|null $callbackQuery = null;

    protected Collection $data;

    protected Keyboard $originalKeyboard;

    protected MenuItem $menuItem;

    public function __construct()
    {
        $this->originalKeyboard = Keyboard::make();
    }

    /**
     * @return void
     */
    public function start($parameter): void
    {
        if (!$this->menuItem) {
            throw new NotFoundHttpException();
        }
        if ($this->menuItem->children->isNotEmpty()) {
            $buttons = $this->menuItem->children()->get()->map(function (MenuItem $menuItem) {
                if ($menuItem->type->id === 3) {
                    return Button::make($menuItem
                        ->getTranslation('name', app()->getLocale()))
                        ->action('/' . $menuItem->slug);
                }
                if ($menuItem->type->id === 1) {
                    return Button::make($menuItem
                        ->getTranslation('name', app()->getLocale()))
                        ->url($menuItem->url);
                }
                if ($menuItem->type->id === 2) {
                    return null;
                }
            })->toArray();
            $chat = $this->chat->message($this->menuItem
                ->getTranslation('description', app()->getLocale()))
                ->keyboard(Keyboard::make()
                    ->buttons($buttons));
            if ($this->menuItem->getMedia('menu_item')->isNotEmpty()) {
                $chat->photo($this->menuItem->getMedia('menu_item')->first()?->getUrl());
            }
            $chat->send();
        }

        if ($this->menuItem->children->isEmpty()) {
            $chat = $this->chat->message($this->menuItem
                ->getTranslation('description', app()->getLocale()))->send();
            if ($this->menuItem->getMedia('menu_item')->isNotEmpty()) {
                $chat->photo($this->menuItem->getMedia('menu_item')->first()?->getUrl());
            }
            $chat->send();
        }
    }

    /**
     * @param string $action
     *
     * @return bool
     */
    protected function canHandle($action): bool
    {
        $menuItem = MenuItem::bySlug($action)->first();
        if ($menuItem !== null) {
            $this->menuItem = $menuItem;
            return true;
        }
        if (in_array($action, ['start', '/start'])) {
            $this->menuItem = MenuItem::whereIsRoot()->first();
            return true;
        }

        return false;
    }

    /**
     * @return void
     */
    protected function handleMessage(): void
    {
        assert($this->message?->chat() !== null);

        /** @var TelegraphChat $chat */
        $chat = $this->bot->chats()->firstOrNew([
            'chat_id' => $this->message->chat()->id(),
        ]);
        $this->chat = $chat;

        if (!$this->chat->exists) {
            if (!config('telegraph.security.allow_messages_from_unknown_chats', false)) {
                throw new NotFoundHttpException();
            }

            if (config('telegraph.security.store_unknown_chats_in_db', false)) {
                $this->chat->name = Str::of("")
                    ->append("[", $this->message->chat()->type(), ']')
                    ->append(" ", $this->message->chat()->title());
                $this->chat->save();
            }
        }

        $this->messageId = $this->message->id();

        $this->data = collect([
            'text' => $this->message->text(),
        ]);

        if (config('telegraph.debug_mode')) {
            Log::debug('Telegraph webhook message', $this->data->toArray());
        }

        $text = Str::of($this->message?->text() ?? '');

        if ($text->startsWith('/')) {
            $this->handleCommand($text);
        }

        if (!$text->startsWith('/')) {
            $this->handleChatMessage($text);
        }
    }

    /**
     * @return void
     */
    protected function handleCallbackQuery()
    {
        /** @var TelegraphChat $chat */
        $chat = $this->bot->chats()->firstOrNew([
            'chat_id' => $this->request->input('callback_query.message.chat.id'),
        ]);

        $this->chat = $chat;

        if (!$this->chat->exists) {
            if (!config('telegraph.security.allow_callback_queries_from_unknown_chats', false)) {
                throw new NotFoundHttpException();
            }

            if (config('telegraph.security.store_unknown_chats_in_db', false)) {
                $this->chat->name = Str::of("")
                    ->append("[", $this->request->input('callback_query.message.chat.type'), ']')
                    ->append(" ", $this->request->input(
                        'callback_query.message.chat.username',
                        $this->request->input('callback_query.message.chat.title')
                    ));

                $this->chat->save();
            }
        }

        assert($this->callbackQuery !== null);

        $this->messageId = $this->callbackQuery->message()?->id() ?? throw TelegramWebhookException::invalidData('message id missing');

        $this->callbackQueryId = $this->callbackQuery->id();

        /** @phpstan-ignore-next-line */
        $this->originalKeyboard = $this->callbackQuery->message()?->keyboard() ?? Keyboard::make();

        $this->data = $this->callbackQuery->data();

        if (config('telegraph.debug_mode')) {
            Log::debug('Telegraph webhook callback', $this->data->toArray());
        }

        $action = Str::of($this->callbackQuery?->data()->get('action') ?? '');

        if (!$this->canHandle($action)) {
            throw new NotFoundHttpException();
        }

        $this->handleCommand($action);
    }

    /**
     * @param Stringable $text
     *
     * @return void
     */
    protected function handleCommand(Stringable $text): void
    {
        $command = (string) $text->after('/')->before(' ')->before('@');
        $parameter = (string) $text->after('@')->after(' ');

        if (!$this->canHandle($command)) {
            $this->handleUnknownCommand($text);
            return;
        }
        if (!method_exists($this, $command)) {
            $this->start($parameter);
        }

        if (method_exists($this, $command)) {
            $this->{$command}($parameter);
        }
    }

    public function handle(Request $request, TelegraphBot $bot): void
    {
        $this->bot = $bot;

        $this->request = $request;
        if ($this->request->has('message')) {
            /* @phpstan-ignore-next-line */
            $this->message = Message::fromArray($this->request->input('message'));
            $this->handleMessage();

            return;
        }

        if ($this->request->has('channel_post')) {
            /* @phpstan-ignore-next-line */
            $this->message = Message::fromArray($this->request->input('channel_post'));
            $this->handleMessage();

            return;
        }


        if ($this->request->has('callback_query')) {
            /* @phpstan-ignore-next-line */
            $this->callbackQuery = CallbackQuery::fromArray($this->request->input('callback_query'));
            $this->handleCallbackQuery();
        }

        if ($this->request->has('inline_query')) {
            /* @phpstan-ignore-next-line */
            $this->handleInlineQuery(InlineQuery::fromArray($this->request->input('inline_query')));
        }
    }

    protected function handleUnknownCommand(Stringable $text): void
    {
        if ($this->message?->chat()?->type() === Chat::TYPE_PRIVATE) {
            $command = (string) $text->after('/')->before(' ')->before('@');

            if (config('telegraph.report_unknown_webhook_commands', true)) {
                report(TelegramWebhookException::invalidCommand($command));
            }

            $this->chat->html("Unknown command")->send();
        }
    }

    protected function handleChatMemberJoined(User $member): void
    {
        // .. do nothing
    }

    protected function handleChatMemberLeft(User $member): void
    {
        // .. do nothing
    }

    protected function handleChatMessage(Stringable $text): void
    {
        // .. do nothing
    }

    protected function replaceKeyboard(Keyboard $newKeyboard): void
    {
        $this->chat->replaceKeyboard($this->messageId, $newKeyboard)->send();
    }

    protected function deleteKeyboard(): void
    {
        $this->chat->deleteKeyboard($this->messageId)->send();
    }

    protected function reply(string $message): void
    {
        $this->bot->replyWebhook($this->callbackQueryId, $message)->send();
    }

    public function chatid(): void
    {
        $this->chat->html("Chat ID: {$this->chat->chat_id}")->send();
    }

    protected function handleInlineQuery(InlineQuery $inlineQuery): void
    {
    }
}
