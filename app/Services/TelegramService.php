<?php

namespace App\Services;

use App\Models\TelegramUpdate;
use Illuminate\Support\Facades\Http;

class TelegramService
{
    public const API_URL = 'https://api.telegram.org/bot';

    public function __call($name, $params)
    {
        $query = [];
        if ($params) {
            foreach ($params[0] as $key => $param) {
                $query[] = $key . '=' . $param;
            }
        }
        $take = count($query) > 0 ? '?' . implode('&', $query) : '';
        $response = Http::get(self::API_URL . env('TELEGRAM_TOKEN') . '/' . $name);

        return $response->json();
    }

    public function saveMessages(array $messages)
    {
        $tm = [];
        foreach ($messages as $message) {
            $tm[] = TelegramUpdate::updateOrCreate([
                'update_id' => $message['update_id']
            ], $message);
        }
        return collect($tm);
    }
}
