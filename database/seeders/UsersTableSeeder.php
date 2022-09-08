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
                'password' => '$2y$10$KDMv9z3Oc0BR04fqPGB1U.HTn6sAjomuQg4LqTXwFqX/.LL6PuZRS',
                'remember_token' => NULL,
                'created_at' => '2022-09-08 07:30:21',
                'updated_at' => '2022-09-08 07:30:21',
            )
        ));
        if (env('APP_ENV') === 'local') {
            \DB::table('users')->insert(array(
                1 =>
                array(
                    'id' => 2,
                    'name' => 'admin',
                    'email' => 'admin@pashkovsky.me',
                    'email_verified_at' => NULL,
                    'password' => '$2y$10$LceV1cCm/r9LBRAR19R0cesN5k2BuK3uybgjabaBUcmrdigcaENJu', //123
                    'remember_token' => NULL,
                    'created_at' => '2022-09-08 07:52:40',
                    'updated_at' => '2022-09-08 07:52:40',
                ),
                2 =>
                array(
                    'id' => 3,
                    'name' => 'user',
                    'email' => 'user@pashkovsky.me',
                    'email_verified_at' => NULL,
                    'password' => '$2y$10$Sa82jetSPXxKxaN5oJBbnOWOkcLLNhWJ2JBpBYN5XxM4qvpvU5MsK', //123
                    'remember_token' => NULL,
                    'created_at' => '2022-09-08 08:00:20',
                    'updated_at' => '2022-09-08 08:00:20',
                ),
            ));
        }
    }
}
