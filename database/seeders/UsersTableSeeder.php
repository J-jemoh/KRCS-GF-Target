<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run() {
        #password: 1234567890

        \DB::table('users')->delete();

        \DB::table('users')->insert(array(
            0 => array(
                'id' => 1,
                'name' => 'James Nyanga',
                'email' => 'jamesnyanga@gmail.com',
                'region'=>'HQ',
                'destination'=>'DMO',
                'email_verified_at' => '2024-01-26 00:57:50',
                'password' => '$2y$10$u6xCHUy6rquDObZNNMxjf.sCNnv6zmkyM4YWfiNO/Efakc3UJmy8G',
                'remember_token' => 'Hm9c1390EEtNGkNkQslDzYlxUZ07JNsVG2JgHMHUKsFPeBrYEHzJEkiKK3V6',
                'created_at' => '2024-01-21 22:43:54',
                'updated_at' => '2024-01-26 01:37:57',
            ),
            1 => array(
                'id' => 2,
                'name' => 'Gordon Aomo',
                'email' => 'aomo.gordon@redcross.or.ke',
                'region'=>'HQ',
                'destination'=>"MEM",
                'email_verified_at' => '2024-01-26 00:57:50',
                'password' => '$2y$10$6hqSIfaLWQhqj325GimdX.tTwD7sr3NXAa5cWBNUd7HrGd7Ec5Z4W',
                'remember_token' => NULL,
                'created_at' => '2024-01-23 08:01:47',
                'updated_at' => '2024-01-23 08:01:47',
            ),
            2 => array(
                'id' => 5,
                'name' => 'Sandra Serune',
                'email' => 'sandra.serune@redcross.or.ke',
                'region'=>'HQ',
                'destination'=>'NMEAL',
                'email_verified_at' => '2024-01-27 11:40:31',
                'password' => '$2y$10$6hqSIfaLWQhqj325GimdX.tTwD7sr3NXAa5cWBNUd7HrGd7Ec5Z4W',
                'remember_token' => NULL,
                'created_at' => '2020-01-27 11:34:47',
                'updated_at' => '2020-01-27 11:40:31',
            ),
        ));

    }
}