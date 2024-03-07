<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('categories')->delete();

        \DB::table('categories')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'ثلاثة اجزاء',
                'record_state' => '1',
                'created_at' => '2024-02-16 14:23:00',
                'updated_at' => '2024-02-16 14:23:00',
                'deleted_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'ربع القران',
                'record_state' => '1',
                'created_at' => '2024-02-16 14:23:00',
                'updated_at' => '2024-02-16 14:23:00',
                'deleted_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'نصف القران',
                'record_state' => '1',
                'created_at' => '2024-02-16 14:23:00',
                'updated_at' => '2024-02-16 14:23:00',
                'deleted_at' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'ثلاث ارباع القران',
                'record_state' => '1',
                'created_at' => '2024-02-16 14:23:00',
                'updated_at' => '2024-02-16 14:23:00',
                'deleted_at' => NULL,
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'القران كاملا',
                'record_state' => '1',
                'created_at' => '2024-02-16 14:23:00',
                'updated_at' => '2024-02-16 14:23:00',
                'deleted_at' => NULL,
            ),
            5 =>
            array (
                'id' => 6,
                'name' => 'اسأله ثقافيه',
                'record_state' => '1',
                'created_at' => '2024-02-16 14:23:00',
                'updated_at' => '2024-02-16 14:23:00',
                'deleted_at' => NULL,
            ),
            6 =>
            array (
                'id' => 7,
                'name' => 'testat',
                'record_state' => '0',
                'created_at' => '2024-02-16 17:14:06',
                'updated_at' => '2024-02-16 17:53:13',
                'deleted_at' => NULL,
            ),
        ));


    }
}
