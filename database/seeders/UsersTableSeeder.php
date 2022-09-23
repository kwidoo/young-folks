<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('users')->delete();

        \DB::table('users')->insert(array(
            0 =>
            array(
                'id' => 1,
                'name' => 'Oleg Pashkovsky',
                'email' => 'oleg@pashkovsky.me',
                'email_verified_at' => '2022-09-08 07:30:21',
                'password' => '$2y$10$JeWFtZCXKskTT4SLtByP3uksvgg9ft6.GmFJBm2XBSfhytYRDZ6gC',
                'remember_token' => NULL,
                'locale' => 'ru',
                'deleted_at' => NULL,
                'created_at' => '2022-09-08 07:30:21',
                'updated_at' => '2022-09-08 07:30:21',
            ),
            3 =>
            array(
                'id' => 4,
                'name' => 'Jana Janovska',
                'email' => 'janovskajana@inbox.lv',
                'email_verified_at' => NULL,
                'password' => '$2y$10$WN7xnoDywMIoAivU.M/zhuzKngm1d2rcNTZtbVhX6sKdEH0vNYkdW',
                'remember_token' => NULL,
                'locale' => 'ru',
                'deleted_at' => NULL,
                'created_at' => '2022-09-23 19:16:51',
                'updated_at' => '2022-09-23 19:16:51',
            ),
            4 =>
            array(
                'id' => 5,
                'name' => 'Aleksandr Morozov',
                'email' => 'info@youngfolks.lv',
                'email_verified_at' => NULL,
                'password' => '$2y$10$AWO9FN4LhgdcwBF2XSWdQuEYjkEQmpELuSceqy5KhNJfNNXjv5dHe',
                'remember_token' => NULL,
                'locale' => 'en',
                'deleted_at' => NULL,
                'created_at' => '2022-09-23 19:18:27',
                'updated_at' => '2022-09-23 19:18:27',
            ),
        ));
    }
}
