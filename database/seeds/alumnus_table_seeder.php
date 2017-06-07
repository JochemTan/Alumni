<?php

use Illuminate\Database\Seeder;
use App\Alumnus;
use Faker\Factory as Faker;
class alumnus_table_seeder extends Seeder
{
	
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function Insertion()
    {
        switch ($r = random_int(0,6)) {
            case 1:
               return "van";
            break;
            case 2:
               return "van der";
            break;
            case 3:
                return "von";
                break;
            default:
                return "";
        }

    }

    public function Education()
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
        $r = random_int(0,24);
        return $eduArray[$r];
    }

    //acces the poscode-api and retive more info
    public function GetPostcodeData($postcode){
        $curl = curl_init('http://postcode-api.nl/adres/'.$postcode);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($result,1)[0];

        return $data;
    }

    public function run()
    {
    	$faker = Faker::create();
        $tries = 0;
        $maxTries = 10000;
   		for ($i=0; $i < 100; $i++) {
            if($tries>$maxTries){
                break;
            }
   		    $tries++;
            $postcode = strtoupper($faker->numberBetween($min = 1011, $max = 9999).$faker->bothify('??')); //$faker->bothify('####??'));
            $postcodeData = $this->GetPostcodeData($postcode);
            if($postcodeData == null || $postcodeData == ""){
                $i--;
                //$postcodeData = ['plaats'=>'','gemeente'=>'','provincie'=>'','longtitude'=>'','latitude'=>''];
            }
            else {
                Alumnus::create(array(
                    'firstname' => $faker->firstname(),
                    'insertion' => $this->Insertion(),
                    'lastname' => $faker->lastname,
                    'birthday' => $faker->dateTimeBetween($startDate = '-50 years', $endDate = '-18 years'),
                    'email' => $faker->bothify('????????') . $faker->email,
                    'postalcode' => $postcode,
                    'place' => $postcodeData['plaats'],
                    'muncipality' => $postcodeData["gemeente"],
                    'longtitude' => $postcodeData["longtitude"],
                    'latitude' => $postcodeData["latitude"],
                    'province' => $postcodeData["provincie"],
                    'function' => $faker->jobTitle,
                    'education' => $this->Education(),
                    'graduationYear' => $faker->numberBetween(2000, 2016),
                    'salary' => $faker->numberBetween(10000, 2000000),
                    // 'profile_image' => 'userpic.png',
                    'guestlecture' => 0,
                    'newsletter' => 0,
                    'prive' => 0,
                ));
            }
        }
    }
}