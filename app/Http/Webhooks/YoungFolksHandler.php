<?php

namespace App\Http\Webhooks;

use App\Models\MenuItem;
use DefStudio\Telegraph\DTO\InlineQuery;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class YoungFolksHandler extends WebhookHandler
{

    protected MenuItem $menuItem;
    /**
     * @return void
     */
    public function start(): void
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
        $this->menuItem = MenuItem::whereSlug(Str::replace('/', '', $action))->first();
        if ($this->menuItem) {
            return true;
        }
        return $parent;
    }

    /**
     * @return void
     */
    private function handleMessage(): void
    {
        $this->extractMessageData();

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
     * @param Stringable $text
     *
     * @return void
     */
    private function handleCommand(Stringable $text): void
    {
        $command = (string) $text->after('/')->before(' ')->before('@');
        $parameter = (string) $text->after('@')->after(' ');

        if (!$this->canHandle($command)) {
            $this->handleUnknownCommand($text);

            return;
        }
        if (!method_exists($this, $command)) {
            $this->start();
        }

        $this->$command($parameter);
    }
}
