<?php

namespace App\Http\Webhooks;

use App\Models\MenuItem;
use DefStudio\Telegraph\DTO\CallbackQuery;
use DefStudio\Telegraph\DTO\InlineQuery;
use DefStudio\Telegraph\DTO\Message;
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
        if (!isset($this->menuItem)) {
            $this->menuItem = MenuItem::whereIsRoot()->first();
        }
        $buttons = $this->menuItem->children()->get()->map(function (MenuItem $menuItem) {
            return Button::make($menuItem->name)->action('/' . $menuItem->slug);
        })->toArray();

        $this->chat->message($this->menuItem->description)->keyboard(Keyboard::make()->buttons($buttons))->send();
    }


    protected function handleChatMessage(Stringable $text): void
    {
        info('chat message', [$text]);
        $this->chat->html('Hi there1!')->send();
    }

    /**
     * @param string $action
     *
     * @return bool
     */
    protected function canHandle(string $action): bool
    {
        $parent = parent::canHandle($action);
        $this->menuItem = MenuItem::whereSlug($action)->orWhere('slug', '/' . $action)->first();
        if ($this->menuItem) {
            return true;
        }
        return $parent;
    }

    /**
     * @return void
     */
    protected function handleMessageYf(): void
    {
        $this->extractMessageData();

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
        $this->extractCallbackQueryData();

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
