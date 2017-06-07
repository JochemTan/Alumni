<?php

use Illuminate\Database\Seeder;
use App\Role;
class role_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(array(
        	'name' => 'Docent',
        	'level' => 1,
        ));
        Role::create(array(
        	'name' => 'Opleidingshoofd',
        	'level' => 2,
        ));
        Role::create(array(
            'name' => 'Communictie',
            'level' => 3,
        ));
        Role::create(array(
            'name' => 'Admin',
            'level' => 4,
        ));
        Role::create(array(
            'name' => 'Directie',
            'level' => 5,
        ));
    }
}
