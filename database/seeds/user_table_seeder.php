<?php

use Illuminate\Database\Seeder;
use App\User;

class user_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(array(
        	'firstname' => 'test',
        	'insertion' => '',
        	'lastname' => 'Testing',
        	'email' => 'phpunit@test.nl',
        	'password' => bcrypt('test1234'),
            'role_id' => 1
        ));
    }
}
