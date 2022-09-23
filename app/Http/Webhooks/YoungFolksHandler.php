<?php

namespace App\Http\Webhooks;

use DefStudio\Telegraph\DTO\InlineQuery;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
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

    public function handleInlineQuery(InlineQuery $inlineQuery): void
    {
        info('inline query', [$inlineQuery]);
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

    private function handleMessage(): void
    {
        $this->extractMessageData();

        if (config('telegraph.debug_mode')) {
            Log::debug('Telegraph webhook message', $this->data->toArray());
        }

        $text = Str::of($this->message?->text() ?? '');

        if ($text->startsWith('/')) {
            $this->handleCommand($text);
        } else {
            $this->handleChatMessage($text);
        }
    }

    private function handleCommand(Stringable $text): void
    {
        $command = (string) $text->after('/')->before(' ')->before('@');
        $parameter = (string) $text->after('@')->after(' ');

        if (!$this->canHandle($command)) {
            $this->handleUnknownCommand($text);

            return;
        }

        $this->$command($parameter);
    }
}
