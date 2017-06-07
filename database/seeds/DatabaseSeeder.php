<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(alumnus_table_seeder::class);
        $this->call(company_table_seeder::class);
        $this->call(role_table_seeder::class);
        $this->call(user_table_seeder::class);
        $this->call(collection_table_seeder::class);
    }
}
