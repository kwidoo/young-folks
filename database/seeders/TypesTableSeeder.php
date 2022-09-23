<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('types')->delete();
        
        \DB::table('types')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => '{"en":"Paid"}',
                'slug' => 'paid',
                'enabled' => 1,
                'deleted_at' => NULL,
                'created_at' => '2022-09-23 16:35:57',
                'updated_at' => '2022-09-23 16:35:57',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => '{"en":"Free"}',
                'slug' => 'free',
                'enabled' => 1,
                'deleted_at' => NULL,
                'created_at' => '2022-09-23 16:40:02',
                'updated_at' => '2022-09-23 16:40:02',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => '{"en":"Menu Item"}',
                'slug' => 'menu-item',
                'enabled' => 1,
                'deleted_at' => NULL,
                'created_at' => '2022-09-23 16:41:21',
                'updated_at' => '2022-09-23 16:41:21',
            ),
        ));
        
        
    }
}