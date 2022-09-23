<?php

namespace Database\Seeders;

use App\Models\Bot;
use Illuminate\Database\Seeder;

class TelegraphBotsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $bot = Bot::create([
            'token' => config('young-folks.token'),
            'name' => config('young-folks.name'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if (config('app.env') === 'prod') {
            $bot = Bot::find(1);
            $bot->registerWebhook()->send();
        }
    }
}
