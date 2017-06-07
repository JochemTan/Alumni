<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Collection;
use App\Role;
use App\User;

class EmployeeController extends Controller
{

    public function __construct()
    {
        // $this->middleware('settings', ['only' =>'specialSettings']);
        // $this->middleware('admin',['only' => 'specialSettings']);
    }
    public function index(){
        $employees = User::all();
        $level = Auth::guard('user')->user()->getRole()->level;
        $roles = Role::query()->get();
//        $roles = Role::query()->where('level', '<=', $level)->get();
        return view('employee.employees', compact('employees','roles'));
    }

    public function SearchEmployees($words){
        $employees = User::query();
        foreach ($words as $keyword){
            $employees->orWhere();
        }

    }

    public function getEmployeesThatMatch(Request $request){
        $employees = User::all();
        $level = Auth::guard('user')->user()->getRole()->level;
        $roles = Role::query()->get();
//        $roles = Role::query()->where('level', '<=', $level)->get();
        //dd($roles);
        return view('employees', compact('employees','roles'));
    }
    public function changeRole(Request $request)
    {
        // data from request
        $roleId = (int)$request->id;
        $email = $request->email;
        // getting data from user
        $user = User::where('email',$email)->first();
        $userid = $user->id;

        $user->role_id = $roleId;
        $user->save();
    }
    public function create()
    {
        $role = Role::all();
        return view('employee.create',compact('role'));
    }
    public function store(Request $request)
    {   
        $this->validate($request,[
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = new User;

        $user->firstname = $request->firstname;
        $user->insertion = $request->insertion;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role_id = $request->rol;
        $user->save();

         \Session::flash('success', 'Gebruiker is aangemaakt!');
        return back();

    }

    public function settings()
    {
        $user = Auth::user();
        $collection = Collection::all();
        return view('employee.settings',compact('user','collection'));
    }
    public function update(Request $request, User $user)
    {

        $this->validate($request,[
            'firstname' => 'required|max:255|string',
            'insertion' => 'max:100|string',
            'lastname' => 'required|max:255|string',
            'jobTitle' =>  'required|digits_between:1,100',
        ]);
        $job = Collection::find($request->jobTitle);
        $user = User::findOrFail(Auth::user()->id);
        $user->firstname = $request->firstname;
        $user->insertion = $request->insertion;
        $user->lastname = $request->lastname;
        $user->jobTitle = $job->name;   
        $user->save();
        return back();
    }

    public function specialSettings()
    {
        $user = Auth::user();
        return view('specialsettings',compact('user'));
    }
    public function settingsUpdate(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);

        if ($request->hasFile('userImage')) {
            //get file from input field 'profileImage'
            $file = $request->file('userImage');

            //change the name with the id together with the timestamp
            $name = Auth::user()->id . "_" . date('j-n-Y_his') . '.jpg';

            //now move the file to path
            $file->move(base_path() . '/public/images/users', $name);

            //and upload the name into the alumnus profile_image
            $user->image = $name;
        }

        $this->validate($request,[
            'firstname' => 'required|max:255|string',
            'insertion' => 'max:100|string',
            'lastname' => 'required|max:255|string',
        ]);
        $user->firstname = $request->firstname;
        $user->insertion = $request->insertion;
        $user->lastname = $request->lastname;
        $user->save();
        \Session::flash('success', 'Gegevens zijn aangepast');
        return back();
    }
}
