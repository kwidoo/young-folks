<?php

namespace App\Http\Webhooks;

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
}
