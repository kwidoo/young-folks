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


        \DB::table('telegraph_bots')->delete();

        \DB::table('telegraph_bots')->insert(array(
            0 =>
            array(
                'id' => 1,
                'token' => config('young-folks.token'),
                'name' => 'Young Folks',
                'created_at' => '2022-09-08 08:46:55',
                'updated_at' => '2022-09-08 08:46:55',
            ),
        ));

        $bot = Bot::find(1);
        $bot->registerWebhook()->send();
    }
}
