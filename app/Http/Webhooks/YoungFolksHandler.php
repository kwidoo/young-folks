<?php

namespace App\Http\Webhooks;

use App\Models\MenuItem;
use DefStudio\Telegraph\DTO\CallbackQuery;
use DefStudio\Telegraph\DTO\InlineQuery;
use DefStudio\Telegraph\DTO\Message;
use DefStudio\Telegraph\Exceptions\TelegramWebhookException;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use DefStudio\Telegraph\Models\TelegraphBot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class YoungFolksHandler extends WebhookHandler
{

    protected ?MenuItem $menuItem = null;
    /**
     * @return void
     */
    public function start($parameter): void
    {
        $buttons = $this->menuItem->children()->get()->map(function (MenuItem $menuItem) {
            return Button::make($menuItem
                ->getTranslation('name', app()->getLocale()))
                ->action('/' . $menuItem->slug);
        })->toArray();


        $this->chat->message($this->menuItem
            ->getTranslation('description', app()->getLocale()))
            ->keyboard(Keyboard::make()
                ->buttons($buttons))->send();
    }

    /**
     * @param string $action
     *
     * @return bool
     */
    protected function canHandle($action): bool
    {
        $this->menuItem = MenuItem::bySlug($action)->first();
        if ($this->menuItem) {
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
    protected function handleMessageYf(): void
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
            $this->handleCommandYF($text);
        }

        if (!$text->startsWith('/')) {
            $this->handleChatMessage($text);
        }
    }

    /**
     * @return void
     */
    protected function handleCallbackQueryYf()
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

        $this->handleCommandYF($action);
    }

    /**
     * @param Stringable $text
     *
     * @return void
     */
    protected function handleCommandYF(Stringable $text): void
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
            $this->handleMessageYf();

            return;
        }

        if ($this->request->has('channel_post')) {
            /* @phpstan-ignore-next-line */
            $this->message = Message::fromArray($this->request->input('channel_post'));
            $this->handleMessageYf();

            return;
        }


        if ($this->request->has('callback_query')) {
            /* @phpstan-ignore-next-line */
            $this->callbackQuery = CallbackQuery::fromArray($this->request->input('callback_query'));
            $this->handleCallbackQueryYf();
        }

        if ($this->request->has('inline_query')) {
            /* @phpstan-ignore-next-line */
            $this->handleInlineQuery(InlineQuery::fromArray($this->request->input('inline_query')));
        }
    }
}
