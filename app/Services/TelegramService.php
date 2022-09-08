<?php

namespace App\Services;

use App\Models\TelegramUpdate;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class TelegramService
{
    public const API_URL = 'https://api.telegram.org/bot';

    /**
     * @param string $name
     * @param mixed $params
     *
     * @return mixed
     */
    public function __call($name, $params)
    {
        $query = [];
        if ($params) {
            foreach ($params[0] as $key => $param) {
                $query[] = $key . '=' . $param;
            }
        }
        $take = count($query) > 0 ? '?' . implode('&', $query) : '';
        $response = Http::get(self::API_URL . env('TELEGRAM_TOKEN') . '/' . $name . $take);

        return $response->json();
    }

    /**
     * @param array<array> $messages
     *
     * @return Collection<int, TelegramUpdate>
     */
    public function saveMessages(array $messages)
    {
        $telegramMessage = [];
        foreach ($messages as $message) {
            $telegramMessage[] = TelegramUpdate::updateOrCreate([
                'update_id' => $message['update_id']
            ], $message);
        }
        return collect($telegramMessage);
    }
}
