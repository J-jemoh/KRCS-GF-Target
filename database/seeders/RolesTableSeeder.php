<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder {

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run() {

        \DB::table('roles')->delete();

        \DB::table('roles')->insert(array(
            0 => array(
                'id' => 1,
                'name' => 'Super Admin',
                'guard_name' => 'web',
                'created_at' => '2024-01-26 13:40:40',
                'updated_at' => '2024-01-26 13:40:40',
            ),
            1 => array(
                'id' => 2,
                'name' => 'Admin',
                'guard_name' => 'web',
                'created_at' => '2024-01-26 13:40:53',
                'updated_at' => '2024-01-26 13:40:53',
            ),
            2 => array(
                'id' => 3,
                'name' => 'MEM',
                'guard_name' => 'web',
                'created_at' => '2024-01-26 13:41:16',
                'updated_at' => '2024-01-26 13:41:16',
            ),
            3 => array(
                'id' => 4,
                'name' => 'RMEO',
                'guard_name' => 'web',
                'created_at' => '2024-01-27 12:23:00',
                'updated_at' => '2024-01-27 12:23:00',
            ),
            4 => array(
                'id' => 6,
                'name' => 'Public User',
                'guard_name' => 'web',
                'created_at' => '2020-01-27 12:43:34',
                'updated_at' => '2020-01-27 12:43:34',
            ),
        ));

    }
}