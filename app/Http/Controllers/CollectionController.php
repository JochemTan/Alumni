<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Collection;

class CollectionController extends Controller
{
    public function index() {
        $educations = Collection::orderBy('name')->paginate(10);
        return view('educations.educations', compact('educations'));
    }

    public function create(Request $request) {
        $educationName = $request->opleiding;
        $newEducation = new Collection;
        $newEducation->name = $educationName;
        $newEducation->save();

        return redirect('educations');
    }
}
