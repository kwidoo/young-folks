<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'SuperAdmin',
                'guard_name' => 'web',
                'created_at' => '2022-09-08 07:33:26',
                'updated_at' => '2022-09-08 07:33:26',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Admin',
                'guard_name' => 'web',
                'created_at' => '2022-09-08 07:33:38',
                'updated_at' => '2022-09-08 07:33:38',
            ),
        ));
        
        
    }
}