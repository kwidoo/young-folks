<?php

namespace App\Http\Webhooks;

use DefStudio\Telegraph\Handlers\WebhookHandler;

class YoungFolksHandler extends WebhookHandler
{
    public function hi(): void
    {
        $this->reply('Hello World!');
    }
}
