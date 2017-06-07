<?php

namespace App\Http\Controllers;
use App\Collection;
use Mail;
use Auth;
use Storage;

use App\User;
use App\Http\Controllers\searchController;
use App\Http\Requests;

use App\Alumnus;
use App\Setting;
use App\Company;
use Carbon\Carbon;
use App\LoginToken;
use Illuminate\Http\Request;
use App\Http\Requests\ImageFormRequest;
use Symfony\Component\Console\Input\Input;

class AlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('alumnus',['only' => 'profile']);
    }

    public function create() {

        $educations = Collection::all();

        return view('employee.createAlumnus', compact('educations'));
    }

    public function store(Request $requests) {
        $email = $requests->email;
        $firstname = $requests->firstname;
        // dd($requests->all());
        $alumnus = new Alumnus;
        $alumnus->firstname = $requests->firstname;
        $alumnus->insertion = $requests->insertion;
        $alumnus->lastname = $requests->lastname;
        $alumnus->email = $requests->email;
        $alumnus->education = $requests->education;
        $alumnus->graduationYear = $requests->graduationYear;
        $alumnus->save();

         Mail::send('mail.alumnusmail',['email' => $email,'firstname' => $firstname], function($m) use($email){
            $m->from('windesheimflevoland@support.nl','Welkom alumnus!');
            $m->to($email)->subject('Windesheim Alumni account is aangemaakt');
        });   
        return redirect('/alumnus/create')->with('msg-success', 'Alumnus toegevoegd');
    }

    //get overview of all alumni.
    public function overview()
    {
        //Grab all alumni out of the database.
        $alumni = Alumnus::all();

        //loop through alumni and use the dateToYear function on birthday date.
        foreach ($alumni as $alumnus) {
            $alumnus->birthday = $this->dateToYear($alumnus->birthday);
        }
        //return array
        return view('overview', compact('alumni'));
    }

    public function getEmail(Request $request, searchController $searchCon)
    {
        //$searchCon = new searchController();
        if($request->alumnusEmail){
            //store the firstname of alumnus in a variable.
            $name = $request->alumnusName;
            //store the email of alumnus in a variable.
            $email = $request->alumnusEmail;
            $alumni[] = ['email' => $email, 'name' => $name];
        } elseif($request->opleidingshoofdName) {

            $opleidingshoofdEmails = [];
            foreach ($request->opleidingshoofdEmail as $email) {
                array_push($opleidingshoofdEmails, $email);
            }
            $opleidingshoofdNames = [];
            foreach ($request->opleidingshoofdName as $name) {
                array_push($opleidingshoofdNames, $name);
            }
        } else {

            if($request->ids) {
                //get all ids of the request and put it in an array instad of a string
                $request->ids = preg_replace('/\s+/', '', $request->ids);
                $ids = explode(",", $request->ids);
                array_pop($ids);
                //dd($ids);
                $Alumni = Alumnus::whereIn('id', $ids)->get();
            } else {
                $searchQuery = $searchCon->getSearchQuery($request);
                $Alumni = $searchQuery->get();
            }

            //loop through all alumni out of the overview
            foreach ($Alumni as $alumnus) {
                //store the email of alumnus in a variable.
                $email = $alumnus->email;
                //store the firstname of alumnus in a variable.
                $name = $alumnus->firstname;
                //place data for every alumnus in an array.
                $alumni[] = ['email' => $email, 'name' => $name];
            }
        }

//        if (in_array("on", $_POST)) {
        return view('mail', compact('alumni', 'opleidingshoofdEmails', 'opleidingshoofdNames'));
//        }else{
//            //return redirect('search');
//            return back()->with('msg-danger', 'U heeft geen alumnus geselecteerd, selecteer eerst een alumnus voordat u een mail kunt versturen.');
//        }
    }

    public function send(Request $request, User $user)
    {
        //grab all posted emails separate on commas, delete all whitespaces and put everything into an array.
        $emails = explode(',', preg_replace('!\s+!', '', $request['email']));
        //grab all posted names separate on commas and delete all whitespaces.
        $names = preg_replace('!\s+!', '', $request['name']);
        //delete the last comma and put everything into an array
        $names = explode(',', rtrim($names, ','));
        //combine array $emails and $names into one array
        $alumni = array_combine($emails, $names);
        //message layout.
        $from = 'Windesheim Support';
        $subject = $request['subject'];
        $bodyMessage = $request['message'];
        //grab the user that is logged in.
        if(Auth::guard('alumnus')->user()) {
            $user = Auth::guard('alumnus')->user();
            $sender = $user->firstname." ".$user->insertion." ".$user->lastname;
        } else {
            $sender = $user->fullname(Auth::user()->id);
        }

        // send each individual alumni a mail.
        foreach ($alumni as $email => $name) {
            Mail::send('mail.standardmail', ['email' => $email, 'name' => $name, 'from' => 'Windesheim Support', 'subject' => $subject, 'bodyMessage' => $bodyMessage, 'sender' => $sender], function ($m) use ($email, $name, $subject, $from, $bodyMessage, $sender) {
                $m->from('no-reply@windesheim.nl', 'Windesheim');

                $m->to($email, $from)->subject($subject);
            });
        }
        //return redirect with a message.
        return redirect('search')->with('msg-success', 'Mail(s) verzonden!');
    }

    //<//////////////////// Alumni Profile ///////////////////////>//
    public function alumnus()
    {
        return Auth::guard('alumnus')->user();
    }

    public function profile()
    {
        //get alumnus with the id\
        $alumnus = Alumnus::where('id', $this->alumnus()->id)->first();
        //find the 'opleidings hoofd'
        $link = $this->emailToOpleidingshoofd($alumnus->education);

        return view('alumnus/alumniProfile', compact('alumnus', 'link'));
    }

    //find 'opleidingshoofd'
    private function emailToOpleidingshoofd($opleiding) {
        //Get users with the same 'opleiding' as the alumnus
        $users = User::where('jobTitle', $opleiding)->get();
        //put all emails in a array
        $emails = [];
        foreach ($users as $hoofd) {
            array_push($emails, $hoofd->email);
        }

        //create a link with all the emails
        $link_part_1 = "";
        foreach ($emails as $email) {
            $link_part_1 .= 'opleidingshoofdEmail[]=' . $email . "&";
        }

        //put al the names in a array
        $names = [];
        foreach ($users as $hoofd) {
            $name = $hoofd->firstname;
            array_push($names, $name);
        }

        //create a link with all the names
        $link_part_2 = "";
        foreach ($names as $name) {
            $link_part_2 .= 'opleidingshoofdName[]=' . $name . "&";
        }
        $link_part_2 = rtrim($link_part_2, "&");

        $link = $link_part_1 . $link_part_2;
        return $link;
    }


    public function edit()
    {
        //get alumnus with the id
        $alumnus = Alumnus::where('id', Auth::guard('alumnus')->user()->id)->first();
        return view('alumnus/alumniProfileEdit', compact('alumnus'));
    }

    private function checkCompany($request)
    {
        //in $request get the company postalcode and delete the spaces and set it into the variable $companyPostalcode.
        $companyPostalcode = preg_replace('!\s+!', '', $request->company_postalcode);

        //create query without really doing anything with it
        //check on name of postalcode because a company can have more locations
        $getCompany = Company::where('name', $request->company_name)->where('postalcode', $companyPostalcode);

        //check if company exists
        //use the query that was just created and check if it exists
        if ($getCompany->exists()) {
            //Now use the created query to get the first result
            $company = $getCompany->first();
            //if it is found. Make sure the rest will be updates of that company.
            $company->description = $request->company_description;
            //update sector
            $company->sector = $request->company_sector;
            //save the company
            $company->save();
            //And put the ID of that company in $company_id.
            $company_id = $company->id;
            return $company_id;

            //if company name is empty then just insert null.
        } elseif (strlen($request->company_name) == 0) {
            $company_id = NULL;
            return $company_id;

            //if company name is not found. Lets add it to the database
        } else {
            $newCompany = new Company();
            $newCompany->name = $request->company_name;
            $newCompany->description = $request->company_description;

            //Get the postalcode and call the API for all the information we need and insert it in
            $company_location = $this->postalcode($companyPostalcode);
            $newCompany->postalcode = $companyPostalcode;
            //if the postalcode if found in the API, use that information
            if ($company_location !== null) {
                $newCompany->province = $company_location['provincie'];
                $newCompany->place = $company_location['plaats'];
                $newCompany->muncipality = $company_location['gemeente'];
                $newCompany->longtitude = $company_location['longtitude'];
                $newCompany->latitude = $company_location['latitude'];


            }
            $newCompany->sector = $request->company_sector;
            //Save the new information
            $newCompany->save();
            //And put the id of the new Company in $company_id
            $company_id = $newCompany->id;
            return $company_id;
        }
    }

    public function save($id,Request $request)
    {
        $alumni = Alumnus::find($request->id);
        // if(!isset($request->prive))?true:false;
        // {
        //     $prive = 0;
        // }
        // else{
        //     $prive = 1;
        // }
        $prive = isset($request->private) ? 1: 0;
        $newsletter = isset($request->newsletter) ? 1: 0;
        $guestlecture = isset($request->guestlecture) ? 1: 0;
        //if an image is found
        if ($request->hasFile('profileImage')) {
            //get file from input field 'profileImage'
            $file = $request->file('profileImage');

            //change the name with the id together with the timestamp
            $name = $this->alumnus()->id . "_" . date('j-n-Y_his') . '.jpg';

            //now move the file to path
            $file->move(base_path() . '/public_html/images/alumnus', $name);

            //and upload the name into the alumnus profile_image
            $alumni->profile_image = $name;
        }

        //get company id
        $company_id = $this->checkCompany($request);

        //and also update the Alumnus data for current alumnus
        $alumni->function = $request->function;
        $alumni->postalcode = $request->postalcode;
        
        //Use the postalcode and call the API for all the information we need and insert it in
        $alumni_location = $this->postalcode($request->postalcode);

        //if the postalcode is found in the API, use that information
        if ($alumni_location !== null) {
            $alumni->province = $alumni_location['provincie'];
            $alumni->place = $alumni_location['plaats'];
            $alumni->muncipality = $alumni_location['gemeente'];
        }
        // Check if setting checkboxes are checked or not


        $alumni->firstname = $request->firstname;
        $alumni->insertion = $request->insertion;
        $alumni->lastname = $request->lastname;
        $alumni->email = $request->email;
        $alumni->company_id = $company_id;
        $alumni->linkedIn = $request->linkedIn;
        $alumni->guestlecture = $guestlecture;
        $alumni->newsletter = $newsletter;
        $alumni->prive = $prive;



        $alumni->save();
        return redirect('/alumnus');
    }

    //    function that we can use multiple time.

    public function FullName($firstname, $insertion, $lastname)
    {
        //set all names in one variable.
        $name = $firstname . " " . $insertion . " " . $lastname;
        //replace multiple spaces into one space.
        $fullName = preg_replace('!\s+!', ' ', $name);
        //return string.
        return $fullName;
    }

    //change birthday to age
    private function dateToYear($alumniDate)
    {
        // parse string to carbon.
        $convertDate = Carbon::parse($alumniDate);
        //check difference between birthday and date of today.
        $age = $convertDate->diff(Carbon::now());
        // return value
        return $age;
    }

    private function postalcode($postalcode)
    {
        $curl = curl_init('http://postcode-api.nl/adres/' . $postalcode);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);
        $location = json_decode($result, 1);
        if (isset($location['error'])) {
            return null;
        } else {
            return $location[0];
        }
    }

    //get all information of alumnus by id.
    //This is used for showing a alumnus profile page
    //and for some functions inside this controller
    public function alumnusById($id)
    {
        $alumnus = Alumnus::find($id);
        //return array
        return $alumnus;
    }

    public function alumnusByIdView($id)
    {
        $alumnus = Alumnus::find($id);
        return view('alumnus/alumniProfile', compact('alumnus'));
    }
    public function showData($email)
    {
        $alumnus = Alumnus::where('email',$email)->first();
        Auth::guard('alumnus')->login($alumnus);
        return view('alumnus.alumniProfile',compact('alumnus'));
    }
    public function alumniByGroupID($groupID){
        $groupMembers = Alumnus::where('group_id', $groupID)->get();
        return  view('group/select', compact('groupMembers'));
    }

//    public function alumniByGroupID($groupID){
//        $groupMembers = Alumnus::where('group_id', $groupID)->get();
//        return  view('group/select', compact('groupMembers'));
//    }
}

