<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('permissions')->delete();

        \DB::table('permissions')->insert(array(
            0 =>
            array(
                'id' => 2,
                'name' => 'users.viewAny',
                'guard_name' => 'web',
                'created_at' => '2022-09-08 08:08:29',
                'updated_at' => '2022-09-08 08:08:29',
            ),
            1 =>
            array(
                'id' => 3,
                'name' => 'user.view',
                'guard_name' => 'web',
                'created_at' => '2022-09-08 08:09:04',
                'updated_at' => '2022-09-08 08:09:04',
            ),
            2 =>
            array(
                'id' => 4,
                'name' => 'users.create',
                'guard_name' => 'web',
                'created_at' => '2022-09-08 08:09:19',
                'updated_at' => '2022-09-08 08:09:19',
            ),
            3 =>
            array(
                'id' => 5,
                'name' => 'users.update',
                'guard_name' => 'web',
                'created_at' => '2022-09-08 08:09:19',
                'updated_at' => '2022-09-08 08:09:19',
            ),
            4 =>
            array(
                'id' => 6,
                'name' => 'users.delete',
                'guard_name' => 'web',
                'created_at' => '2022-09-08 08:09:19',
                'updated_at' => '2022-09-08 08:09:19',
            ),
        ));
    }
}
