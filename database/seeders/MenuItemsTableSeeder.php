<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MenuItemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('menu_items')->delete();

        \DB::table('menu_items')->insert(array(
            0 =>
            array(
                'id' => 2,
                'slug' => 'deti-nachat',
                'enabled' => 1,
                'type_id' => 3,
                'name' => '{"ru":"\\u0414\\u0435\\u0442\\u0438","lv":null}',
                'description' => '{"ru":"Add description"}',
                'params' => NULL,
                'sort_order' => 1,
                '_lft' => 24,
                '_rgt' => 35,
                'parent_id' => 23,
                'deleted_at' => NULL,
                'created_at' => '2022-09-23 16:40:20',
                'updated_at' => '2022-09-23 19:02:21',
            ),
            1 =>
            array(
                'id' => 3,
                'slug' => 'podrostki-nachat',
                'enabled' => 1,
                'type_id' => 3,
                'name' => '{"ru":"\\u041f\\u043e\\u0434\\u0440\\u043e\\u0441\\u0442\\u043a\\u0438","lv":null}',
                'description' => '{"ru":"Add description"}',
                'params' => NULL,
                'sort_order' => 1,
                '_lft' => 16,
                '_rgt' => 23,
                'parent_id' => 23,
                'deleted_at' => NULL,
                'created_at' => '2022-09-23 16:40:45',
                'updated_at' => '2022-09-23 19:02:21',
            ),
            2 =>
            array(
                'id' => 4,
                'slug' => 'molodezh-nachat',
                'enabled' => 1,
                'type_id' => 3,
                'name' => '{"ru":"\\u041c\\u043e\\u043b\\u043e\\u0434\\u0435\\u0436\\u044c","lv":null}',
                'description' => '{"ru":"Add description"}',
                'params' => NULL,
                'sort_order' => 2,
                '_lft' => 36,
                '_rgt' => 43,
                'parent_id' => 23,
                'deleted_at' => NULL,
                'created_at' => '2022-09-23 16:40:57',
                'updated_at' => '2022-09-23 19:02:21',
            ),
            3 =>
            array(
                'id' => 5,
                'slug' => 'drugoe-nachat',
                'enabled' => 1,
                'type_id' => 3,
                'name' => '{"ru":"\\u0414\\u0440\\u0443\\u0433\\u043e\\u0435","lv":null}',
                'description' => '{"ru":"Add description"}',
                'params' => NULL,
                'sort_order' => 0,
                '_lft' => 2,
                '_rgt' => 15,
                'parent_id' => 23,
                'deleted_at' => NULL,
                'created_at' => '2022-09-23 16:41:06',
                'updated_at' => '2022-09-23 19:02:21',
            ),
            4 =>
            array(
                'id' => 6,
                'slug' => 'vyezdnye-lagerya',
                'enabled' => 1,
                'type_id' => 3,
                'name' => '{"ru":"\\u0412\\u044b\\u0435\\u0437\\u0434\\u043d\\u044b\\u0435 \\u043b\\u0430\\u0433\\u0435\\u0440\\u044f","lv":null}',
                'description' => '{"ru":"Add description"}',
                'params' => NULL,
                'sort_order' => 3,
                '_lft' => 25,
                '_rgt' => 26,
                'parent_id' => 2,
                'deleted_at' => NULL,
                'created_at' => '2022-09-23 16:57:48',
                'updated_at' => '2022-09-23 19:02:21',
            ),
            5 =>
            array(
                'id' => 7,
                'slug' => 'letnyaya-shkola',
                'enabled' => 1,
                'type_id' => 3,
                'name' => '{"ru":"\\u041b\\u0435\\u0442\\u043d\\u044f\\u044f \\u0448\\u043a\\u043e\\u043b\\u0430","lv":null}',
                'description' => '{"ru":"Add description"}',
                'params' => NULL,
                'sort_order' => 4,
                '_lft' => 27,
                '_rgt' => 28,
                'parent_id' => 2,
                'deleted_at' => NULL,
                'created_at' => '2022-09-23 16:59:20',
                'updated_at' => '2022-09-23 19:02:21',
            ),
            6 =>
            array(
                'id' => 8,
                'slug' => 'zanyatiya',
                'enabled' => 1,
                'type_id' => 3,
                'name' => '{"ru":"\\u0417\\u0430\\u043d\\u044f\\u0442\\u0438\\u044f","lv":null}',
                'description' => '{"ru":"Add description"}',
                'params' => NULL,
                'sort_order' => 5,
                '_lft' => 29,
                '_rgt' => 30,
                'parent_id' => 2,
                'deleted_at' => NULL,
                'created_at' => '2022-09-23 16:59:29',
                'updated_at' => '2022-09-23 19:02:21',
            ),
            7 =>
            array(
                'id' => 9,
                'slug' => 'master-klassy',
                'enabled' => 1,
                'type_id' => 3,
                'name' => '{"ru":"\\u041c\\u0430\\u0441\\u0442\\u0435\\u0440-\\u043a\\u043b\\u0430\\u0441\\u0441\\u044b","lv":null}',
                'description' => '{"ru":"Add description"}',
                'params' => NULL,
                'sort_order' => 6,
                '_lft' => 31,
                '_rgt' => 32,
                'parent_id' => 2,
                'deleted_at' => NULL,
                'created_at' => '2022-09-23 17:00:09',
                'updated_at' => '2022-09-23 19:02:21',
            ),
            8 =>
            array(
                'id' => 10,
                'slug' => 'organizaciya-detskih-prazdnikov',
                'enabled' => 1,
                'type_id' => 3,
                'name' => '{"ru":"\\u041e\\u0440\\u0433\\u0430\\u043d\\u0438\\u0437\\u0430\\u0446\\u0438\\u044f \\u0434\\u0435\\u0442\\u0441\\u043a\\u0438\\u0445 \\u043f\\u0440\\u0430\\u0437\\u0434\\u043d\\u0438\\u043a\\u043e\\u0432","lv":null}',
                'description' => '{"ru":"Add description"}',
                'params' => NULL,
                'sort_order' => 7,
                '_lft' => 33,
                '_rgt' => 34,
                'parent_id' => 2,
                'deleted_at' => NULL,
                'created_at' => '2022-09-23 17:00:24',
                'updated_at' => '2022-09-23 19:02:21',
            ),
            9 =>
            array(
                'id' => 11,
                'slug' => 'intensivy-vyezdy-lagerya-2',
                'enabled' => 1,
                'type_id' => 3,
                'name' => '{"ru":"\\u0418\\u043d\\u0442\\u0435\\u043d\\u0441\\u0438\\u0432\\u044b, \\u0432\\u044b\\u0435\\u0437\\u0434\\u044b, \\u043b\\u0430\\u0433\\u0435\\u0440\\u044f","lv":null}',
                'description' => '{"ru":"Add description"}',
                'params' => NULL,
                'sort_order' => 8,
                '_lft' => 17,
                '_rgt' => 18,
                'parent_id' => 3,
                'deleted_at' => NULL,
                'created_at' => '2022-09-23 17:02:47',
                'updated_at' => '2022-09-23 19:02:21',
            ),
            10 =>
            array(
                'id' => 12,
                'slug' => 'kursy-platnye-zanyatiya-2',
                'enabled' => 1,
                'type_id' => 3,
                'name' => '{"ru":"\\u041a\\u0443\\u0440\\u0441\\u044b, \\u043f\\u043b\\u0430\\u0442\\u043d\\u044b\\u0435 \\u0437\\u0430\\u043d\\u044f\\u0442\\u0438\\u044f","lv":null}',
                'description' => '{"ru":"Add description"}',
                'params' => NULL,
                'sort_order' => 9,
                '_lft' => 19,
                '_rgt' => 20,
                'parent_id' => 3,
                'deleted_at' => NULL,
                'created_at' => '2022-09-23 17:03:07',
                'updated_at' => '2022-09-23 19:02:21',
            ),
            11 =>
            array(
                'id' => 13,
                'slug' => 'klub-podrostkov-2',
                'enabled' => 1,
                'type_id' => 3,
                'name' => '{"ru":"\\u041a\\u043b\\u0443\\u0431 \\u043f\\u043e\\u0434\\u0440\\u043e\\u0441\\u0442\\u043a\\u043e\\u0432","lv":null}',
                'description' => '{"ru":"Add description"}',
                'params' => NULL,
                'sort_order' => 10,
                '_lft' => 21,
                '_rgt' => 22,
                'parent_id' => 3,
                'deleted_at' => NULL,
                'created_at' => '2022-09-23 17:03:33',
                'updated_at' => '2022-09-23 19:02:21',
            ),
            12 =>
            array(
                'id' => 14,
                'slug' => 'kursy-zanyatiya-3',
                'enabled' => 1,
                'type_id' => 3,
                'name' => '{"ru":"\\u041a\\u0443\\u0440\\u0441\\u044b, \\u0437\\u0430\\u043d\\u044f\\u0442\\u0438\\u044f","lv":null}',
                'description' => '{"ru":"Add description"}',
                'params' => NULL,
                'sort_order' => 11,
                '_lft' => 37,
                '_rgt' => 38,
                'parent_id' => 4,
                'deleted_at' => NULL,
                'created_at' => '2022-09-23 17:03:58',
                'updated_at' => '2022-09-23 19:02:21',
            ),
            13 =>
            array(
                'id' => 15,
                'slug' => 'klub-molodezhi-3',
                'enabled' => 1,
                'type_id' => 3,
                'name' => '{"ru":"\\u041a\\u043b\\u0443\\u0431 \\u043c\\u043e\\u043b\\u043e\\u0434\\u0435\\u0436\\u0438","lv":null}',
                'description' => '{"ru":"Add description"}',
                'params' => NULL,
                'sort_order' => 12,
                '_lft' => 39,
                '_rgt' => 40,
                'parent_id' => 4,
                'deleted_at' => NULL,
                'created_at' => '2022-09-23 17:04:09',
                'updated_at' => '2022-09-23 19:02:21',
            ),
            14 =>
            array(
                'id' => 16,
                'slug' => 'erasmus-3',
                'enabled' => 1,
                'type_id' => 3,
                'name' => '{"ru":"Erasmus+","lv":null}',
                'description' => '{"ru":"Add description"}',
                'params' => NULL,
                'sort_order' => 13,
                '_lft' => 41,
                '_rgt' => 42,
                'parent_id' => 4,
                'deleted_at' => NULL,
                'created_at' => '2022-09-23 17:04:23',
                'updated_at' => '2022-09-23 19:02:21',
            ),
            15 =>
            array(
                'id' => 17,
                'slug' => 'pomoshch-bezhencam-4',
                'enabled' => 1,
                'type_id' => 3,
                'name' => '{"ru":"\\u041f\\u043e\\u043c\\u043e\\u0449\\u044c \\u0431\\u0435\\u0436\\u0435\\u043d\\u0446\\u0430\\u043c","lv":null}',
                'description' => '{"ru":"Add description"}',
                'params' => NULL,
                'sort_order' => 14,
                '_lft' => 3,
                '_rgt' => 4,
                'parent_id' => 5,
                'deleted_at' => NULL,
                'created_at' => '2022-09-23 17:04:56',
                'updated_at' => '2022-09-23 19:02:21',
            ),
            16 =>
            array(
                'id' => 18,
                'slug' => 'young-works-4',
                'enabled' => 1,
                'type_id' => 3,
                'name' => '{"ru":"Young Works","lv":null}',
                'description' => '{"ru":"Add description"}',
                'params' => NULL,
                'sort_order' => 15,
                '_lft' => 5,
                '_rgt' => 6,
                'parent_id' => 5,
                'deleted_at' => NULL,
                'created_at' => '2022-09-23 17:05:07',
                'updated_at' => '2022-09-23 19:02:21',
            ),
            17 =>
            array(
                'id' => 19,
                'slug' => 'sayit-ring-4',
                'enabled' => 1,
                'type_id' => 3,
                'name' => '{"ru":"Sayit.ring","lv":null}',
                'description' => '{"ru":"Add description"}',
                'params' => NULL,
                'sort_order' => 16,
                '_lft' => 7,
                '_rgt' => 8,
                'parent_id' => 5,
                'deleted_at' => NULL,
                'created_at' => '2022-09-23 17:05:29',
                'updated_at' => '2022-09-23 19:02:21',
            ),
            18 =>
            array(
                'id' => 20,
                'slug' => 'kekstarter-4',
                'enabled' => 1,
                'type_id' => 3,
                'name' => '{"ru":"Kekstarter","lv":null}',
                'description' => '{"ru":"Add description"}',
                'params' => NULL,
                'sort_order' => 17,
                '_lft' => 9,
                '_rgt' => 10,
                'parent_id' => 5,
                'deleted_at' => NULL,
                'created_at' => '2022-09-23 17:05:40',
                'updated_at' => '2022-09-23 19:02:21',
            ),
            19 =>
            array(
                'id' => 21,
                'slug' => 'tavariga-4',
                'enabled' => 1,
                'type_id' => 3,
                'name' => '{"ru":"TavaRiga","lv":null}',
                'description' => '{"ru":"Add description"}',
                'params' => NULL,
                'sort_order' => 18,
                '_lft' => 11,
                '_rgt' => 12,
                'parent_id' => 5,
                'deleted_at' => NULL,
                'created_at' => '2022-09-23 17:05:49',
                'updated_at' => '2022-09-23 19:02:21',
            ),
            20 =>
            array(
                'id' => 22,
                'slug' => 'voice-media-4',
                'enabled' => 1,
                'type_id' => 3,
                'name' => '{"ru":"Voice Media","lv":null}',
                'description' => '{"ru":"Add description"}',
                'params' => NULL,
                'sort_order' => 19,
                '_lft' => 13,
                '_rgt' => 14,
                'parent_id' => 5,
                'deleted_at' => NULL,
                'created_at' => '2022-09-23 17:06:03',
                'updated_at' => '2022-09-23 19:02:21',
            ),
            21 =>
            array(
                'id' => 23,
                'slug' => 'nachat',
                'enabled' => 1,
                'type_id' => 3,
                'name' => '{"ru":"\\u041a\\u0430\\u043a\\u0430\\u044f \\u0432\\u043e\\u0437\\u0440\\u0430\\u0441\\u0442\\u043d\\u0430\\u044f \\u043a\\u0430\\u0442\\u0435\\u0433\\u043e\\u0440\\u0438\\u044f \\u0432\\u0430\\u0441 \\u0438\\u043d\\u0442\\u0435\\u0440\\u0435\\u0441\\u0443\\u0435\\u0442?","lv":null}',
                'description' => '{"ru":"Add description"}',
                'params' => NULL,
                'sort_order' => 20,
                '_lft' => 1,
                '_rgt' => 44,
                'parent_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2022-09-23 17:08:44',
                'updated_at' => '2022-09-23 19:02:21',
            ),
        ));
    }
}
