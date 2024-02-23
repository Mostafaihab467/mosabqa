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
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'role' => 'user',
                'name' => 'Abdelrhman Mgahed',
                'email' => '29805180200352@mosabqa.com',
                'email_verified_at' => NULL,
                'nid' => '29805180200352',
                'gender' => 'M',
                'birth_date' => '1998-05-18',
                'password' => '$2y$12$lkESoTrUyXhwu9DGE9BO1.AXfoQKAffMjjoHyE/FHEqVTtPXmDi4q',
                'answered' => 0,
                'remember_token' => NULL,
                'created_at' => '2024-02-16 15:02:42',
                'updated_at' => '2024-02-16 15:02:42',
                'deleted_at' => NULL,
                'grade' => NULL,
            ),
        ));
        
        
    }
}