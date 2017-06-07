<?php

namespace App\Http\Controllers;

use App\Alumnus;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Group;
use Illuminate\Pagination\Paginator;
use App\User;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function index(Request $request)
    {
        //for keeping the search query
        $getParams = $request->except('page');

        //get groups from user
        $groups = $this->GroupFromUser();

        //all Group id in an array
        $groupsid = [];
        foreach($groups as $group) {
            array_push($groupsid, $group->id) ;
        }

        //count the aantal from the group
        $groups->count = [];
        foreach($groupsid as $id) {
            $group = Group::find($id);
            $groups->count[$id] = $group->alumnus()->distinct()->count();
            $groups->members[$id] = $group->alumnus()->get();
        }

        return view('group/index', compact('groups', 'getParams'));

    }

    public function create(Request $request) {
        //dd($request);

        $userID = Auth::guard('user')->user()->id;

        $group = new Group;
        $group->name = $request->groupName;
        $group->save();

        $group = Group::find($group->id);
        $group->user()->attach($userID);

        return redirect('groups');
    }

    public function GroupFromUser() {

        $userID = Auth::guard('user')->user()->id;

        $user = User::find($userID);
        $user_groups = $user->group()->orderBy('name')->paginate(10);

        return $user_groups;
    }

    public function allGroups()
    {
        return Group::all();
    }

    public function addToGroup(Request $request) {

        //get the group number
        $group_id = $request->group;
        //the group value is now a string, convert it to a number
        $group_id = (int) $group_id;

        //get all alumni ID's from request
        $alumniIDs = [];
        foreach ($request->except('_token', 'group') as $id => $value) {
            array_push($alumniIDs, $id);
        }

        //find the group
        $group = Group::find($group_id);

        //get al the existing members in that group
        $groupMembers = $group->alumnus()->distinct()->get();

        //put al the existing members id in the $alumniID array
        //because the sync function will override all the records.
        //So we want the existing and the new ones, added to the group.
        foreach ($groupMembers as $member) {
            array_push($alumniIDs, $member->id);
        }

        //make sure that we got no duplicates
        $alumniIDs = array_unique($alumniIDs);

        //Now sync the group with all the members
        $group->alumnus()->sync($alumniIDs);

        return redirect('search')->with('msg-success', 'Leden toegevoegd');
    }

    public function groupMembers($id) {
        $group = Group::find($id);
        $groupMembers = $group->alumnus()->distinct()->get();

        If(count($groupMembers) == 0){
            return redirect('groups')->with('msg-danger', 'Geen leden gevonden');
        } else {
            return view('group/select', compact('groupMembers'));
        }
    }
}
