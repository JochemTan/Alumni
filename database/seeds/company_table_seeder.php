<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Company;
class company_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i=0; $i < 10; $i++) { 
        	Company::create(array(
        		'name' => $faker->company,
        		'description' => $faker->sentence($nbWords = 8, $variableNbWords = true),
        		'postalcode' => '1221WT',
        		'sector' => 'Software dev .B.V',
        	));
        }
    }
}
