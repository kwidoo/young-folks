<?php

namespace App\Http\Webhooks;

use DefStudio\Telegraph\DTO\InlineQuery;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use Illuminate\Support\Stringable;

class YoungFolksHandler extends WebhookHandler
{
    public function hi(): void
    {
        info('callback', [$this->data]);
        $this->chat->html('Hi there!')->keyboard(Keyboard::make()
            ->buttons([
                Button::make('foo'),
                Button::make('bar'),
                Button::make('baz'),
            ]))->send();
    }

    protected function handleChatMessage(Stringable $text): void
    {
        info('chat message', [$text]);
        $this->chat->html('Hi there1!')->send();
    }

    protected function handleInlineQuery(InlineQuery $inlineQuery): void
    {
        info('inline query', [$inlineQuery]);
        $this->chat->html('Hi there!2')->send();
    }
}
