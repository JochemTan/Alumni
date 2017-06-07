<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Alumnus;
use App\Filters;
use Illuminate\Support\Facades\DB;

class searchController extends Controller
{
    // private $searchFields = ['name', 'location', 'email','education','function', 'graduationYear'];
    public function __construct()
    {
        $this->middleware('search');
    }
    private function cutSearchTerm($string)
    {
        //expected this to need more code
        $stringArray = explode(" ", $string);
        return $stringArray;
    }

    private function addKeywordToQuery($query,$searchCategory, $keyword)
    {
        switch ($searchCategory) {
            case "name":
                //name includes all parts
                $query = $query->orWhere('firstname', "LIKE", '%' . $keyword . '%');
                $query = $query->orWhere('insertion', "LIKE", '%' . $keyword . '%');
                $query = $query->orWhere('lastname', "LIKE", '%' . $keyword . '%');
                break;
            case "location":
                //multiple locations
                $query = $query->orWhere('postalcode', "LIKE", '%' . $keyword . '%');
                $query = $query->orWhere('province', "LIKE", '%' . $keyword . '%');
                $query = $query->orWhere('place', "LIKE", '%' . $keyword . '%');
                $query = $query->orWhere('muncipality', "LIKE", '%' . $keyword . '%');
                break;
            case "graduationYear":
                //this allows for range finding in graduationYear
                $stringArray = explode("-", $keyword);
                if(count($stringArray) == 2) {
                    $query = $query->orWhereBetween('graduationYear', $stringArray);
                }else{
                    $query = $query->orWhere('graduationYear', "LIKE", '%' . $keyword . '%');
                }
                break;
            default:
                $query = $query->orWhere($searchCategory, "LIKE", '%' . $keyword . '%');
        }
        return $query;
        dd($query->toSql());
    }

    //adds sql to the query that for each provided searchCategory checks if it matches te keyword
    private function addMultipleKeywordsToQuery($query, $keyword)
    {
        $searchFields = Filters::getArray();
        //for each category add or clauses for each
        foreach ($searchFields as $searchCategory) {
            $query = $this->addKeywordToQuery($query,$searchCategory,$keyword);
        }
        return $query;
    }

    private function getQuery($request)
    {
        $searchTerm = $request->input('searchTerm');
        $searchTermArray = $this->cutSearchTerm($searchTerm);

        //start an empty query for alumni
        $mainQuery = Alumnus::query();
        //go trough al words that are typed
        foreach ($searchTermArray as $searchValue) {
            //divide each word in a seperate and where statment
            $stringArray = explode(":", $searchValue);
            if(count($stringArray) == 2) {
//                ->where($stringArray[0], "LIKE", '%' . $stringArray[1] . '%'
                //
                if(substr($searchValue, 0, 1) == "+")
                {
                    $stringArray[0] = substr($stringArray[0], 1);
                    $mainQuery =$this->addKeywordToQuery($mainQuery,$stringArray[0],$stringArray[1]);

                }else{
                    $mainQuery->where(function ($subQuery) use ($stringArray) {
                        //for each word search all filter values
                        $this->addKeywordToQuery($subQuery,$stringArray[0],$stringArray[1]);
                    });
                }
            }
            else {
                switch (substr($searchValue, 0, 1)) {
                    case "-":
                        $subSearchValue = substr($searchValue, 1);
                        $mainQuery->whereNotIn('Alumnus.id', function ($subQuery) use ($subSearchValue) {
                            //for each word search all filter values
                            $this->addMultipleKeywordsToQuery($subQuery, $subSearchValue);
                        });
                        break;
                    case "+":
                        $subSearchValue = substr($searchValue, 1);
                        $mainQuery->orWhere(function ($subQuery) use ($subSearchValue) {
                            //for each word search all filter values
                            $this->addMultipleKeywordsToQuery($subQuery, $subSearchValue);
                        });
                        break;
                    default:
                        $mainQuery->where(function ($subQuery) use ($searchValue) {
                            //for each word search all filter values
                            $this->addMultipleKeywordsToQuery($subQuery, $searchValue);
                        });
                        break;
                }
            }
        }
        return $mainQuery;
    }

    public function getSearchQuery($request)
    {   //function that preps variavbles of the class for the otter functions
        $searchQuery = Alumnus::query();
//        $this->setFilters($request);
        //if no search term? why search?
        if ($request->has('searchTerm')) {
            $searchQuery = $this->getQuery($request);
        }
        return $searchQuery;
    }

    public function index(Request $request)
    {
        //save the start time
        $startTime = microtime(true);
        $resultsPerPage = 30;

        //set up all values to send to view
        //get the query for fetching search results and paginate them
        $alumni =  $this->getSearchQuery($request)->paginate($resultsPerPage);
        $searchTerm = $request->input('searchTerm');
        //calc how long the query took
        $duration = round(microtime(true) - $startTime, 4);
        $numTotal = $alumni->total();
        $groups = app('App\Http\Controllers\GroupController')->GroupFromUser();
        //now lets return the view with all data
        return view('search', compact('alumni', 'searchTerm', 'duration','numTotal', 'groups'));
    }

    //easy redirect most data retrieval moved to statisticsController
    public function graphs(Request $request)
    {
        $searchTerm = $request->input('searchTerm');
        return view('graphs', compact('searchTerm'));
    }

    //returns all search results in json array. can be to much
    public function getAlumniData(Request $request)
    {
        $alumni = $this->getSearchQuery($request)->get();
        return response()->json($alumni);
    }

    //returns $resultsPerPage search results in json array.
    public function getAlumniDataPaginate(Request $request)
    {
        $resultsPerPage = 100;
        $alumni = $this->getSearchQuery($request)->paginate($resultsPerPage);
        return response()->json($alumni);
    }


}
