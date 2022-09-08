<?php

namespace App\Http\Webhooks;

use DefStudio\Telegraph\DTO\InlineQuery;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use Illuminate\Support\Stringable;

class YoungFolksHandler extends WebhookHandler
{
    public function hi(): void
    {
        info('callback', [$this->data]);
        $this->chat->html('Hi there!');
    }

    protected function handleChatMessage(Stringable $text): void
    {
        info('chat message', [$text]);
    }

    protected function handleInlineQuery(InlineQuery $inlineQuery): void
    {
        info('inline query', [$inlineQuery]);
    }
}
