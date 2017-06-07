<?php

use Illuminate\Database\Seeder;
use App\Collection;

class collection_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $eduArray = [
            'Bedrijfseconomie',
            'Bedrijfskunde MER',
            'Bouwkunde',
            'Commerciële Economie',
            'Communicatie',
            'Engineering',
            'HBO-ICT',
            'HBO-Rechten',
            'Human Resource Management',
            'Industrieel Product Ontwerpen',
            'Lerarenopleiding Basisonderwijs Pabo',
            'Logopedie',
            'Maatschappelijk Werk en Dienstverlening',
            'Pedagogiek',
            'Ruimtelijke Ontwikkeling - Mobiliteit',
            'Small Business en Retail Management',
            'Sociaal Pedagogische Hulpverlening',
            'Social Work',
            'Teachers College',
            'Verpleegkunde',
            'Werktuigbouwkunde',
            'Commerciële Economie Associate degree',
            'Officemanagement Associate degree',
            'Ondernemen Associate degree',
            'Software Development Associate degree'];

            foreach ($eduArray as $edu) {
            	Collection::create(array(
            		'name' => $edu,
            	));
            }
    }
}
