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
        info('cbQ', [request()->all()]);
        $this->chat->message('hi there')->keyboard(Keyboard::make()->buttons([
            Button::make('One')->action('two')->param('id', '42'),
            Button::make('open')->url('https://test.it'),
            Button::make('Web App')->webApp('https://web-app.test.it'),
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

    public function two(): void
    {
        $this->chat->message('Two')->keyboard(Keyboard::make()->buttons([
            Button::make('Two')->action('more')->param('id', '42')
        ]))->send();
    }

    protected function canHandle(string $action): bool
    {
        $parent = parent::canHandle($action);

        // @todo add logic here
        return $parent;
    }
}
