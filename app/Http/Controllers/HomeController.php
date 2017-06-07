<?php

namespace App\Http\Controllers;
use App\Alumnus;
use App\Company;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function index()
    {
        if(Auth::user())
        {
            return view('home');
        }
        else{
            return view('portal');
        }
    }

    public function directie()
    {
        $mapDetails = [];
        $alumni = Alumnus::all();
        foreach ($alumni as $alumnus ) {
            if($alumnus->company_id != NULL)
            {
                 $mapDetails[] = array(
                'lat' => (double)$alumnus->company->latitude,
                'lng' => (double)$alumnus->company->longtitude,
                );                 
            }
           
        }
        // dd($mapDetails);
        // return response()->json($mapDetails);
        return view('directie',compact('mapDetails'));
    }
    public function testing()
    {
        $alumni = Alumnus::all();
        foreach ($alumni as $alumnus ) {
            if($alumnus->company_id != NULL)
            {
                 $mapDetails[] = array(
                'lat' => (double)$alumnus->company->latitude,
                'lng' => (double)$alumnus->company->longtitude,
                );                 
            }
           
        }
        dd($mapDetails);
    }
}
