<?php

namespace App\Http\Controllers;
use App\Http\Controllers\searchController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Alumnus;


class StatisticsController extends Controller
{
    public function getDataPer($dataType,Request $request)
    {   //create an instance of the search controller
        $searchCon = new searchController();
        //then get an qeary so i can group the results
        $searchQuery = $searchCon->getSearchQuery($request);
        $searchQuery = $searchQuery->addSelect(DB::raw('COUNT(`id`) as total,'.$dataType))->groupBy($dataType);
        //fetch that data
        $alumni = $searchQuery->get();
        //restructure it for logical array access (datatype being the key)
        $data = [];
        foreach($alumni as $alumnus){
            $data[$alumnus->$dataType]= $alumnus->total;
        }

        return response()->json(['data' => $data]);
    }

    public function getPercentagesDataPer($dataType,Request $request)
    {
        $dataType =  filter_var($dataType, FILTER_SANITIZE_STRING);
        //create an instance of the search controller
        $searchCon = new searchController();
        //then get an qeary so i can group the results
        $searchQuery = $searchCon->getSearchQuery($request);
        $searchQuery = $searchQuery->addSelect(DB::raw('COUNT(`id`) as total,'.$dataType))->groupBy($dataType);
        $normalQuery = Alumnus::query()->addSelect(DB::raw('COUNT(`id`) as total,'.$dataType))->groupBy($dataType);
        //fetch that data
        $alumni = $searchQuery->get();
        $allAlumni = $normalQuery->get();
        //restructure it for logical array access (datatype being the key)
        $data = [];
        foreach($alumni as $alumnus){
            $data[$alumnus->$dataType]= $alumnus->total;
        }
        $allData = [];
        foreach($allAlumni as $alumnus){
            $allData[$alumnus->$dataType]= $alumnus->total;
        }
        //calculate percentages
        foreach($data as $key=>$alumnusData){
            $data[$key]=  round(($alumnusData/$allData[$key])*100,2);
        }

        return response()->json(['data' => $data]);
    }

    public function getTotalPercentagesDataPer($dataType,Request $request)
    {
        $dataType =  filter_var($dataType, FILTER_SANITIZE_STRING);
        //create an instance of the search controller
        $searchCon = new searchController();
        //then get an qeary so i can group the results
        $searchQuery = $searchCon->getSearchQuery($request);
        $searchQuery->addSelect(DB::raw('COUNT(`id`) as total,'.$dataType))->groupBy($dataType);

        //fetch that data
        $alumni = $searchQuery->get();
        $total = $searchCon->getSearchQuery($request)->count();
        //restructure it for logical array access (datatype being the key)
        $data = [];
        foreach($alumni as $alumnus){
            $data[$alumnus->$dataType]= round(($alumnus->total/$total)*100,2);
        }

        return response()->json(['data' => $data]);
    }

    public function getAllPercentagesDataPer($dataType,Request $request)
    {
        $dataType =  filter_var($dataType, FILTER_SANITIZE_STRING);
        //create an instance of the search controller
        $searchCon = new searchController();
        //then get an qeary so i can group the results
        $searchQuery = $searchCon->getSearchQuery($request);
        $searchQuery->addSelect(DB::raw('COUNT(`id`) as total,'.$dataType))->groupBy($dataType);

        //fetch that data
        $alumni = $searchQuery->get();
        $total = Alumnus::count();
        //restructure it for logical array access (datatype being the key)
        $data = [];
        foreach($alumni as $alumnus){
            $data[$alumnus->$dataType]=  round(($alumnus->total/$total)*100,2);
        }

        return response()->json(['data' => $data]);
    }

    // Directie stats 
    public function maps()
    {
        $longtitude = [];
        $latitude = [];
        $alumni = Alumnus::all();
        foreach($alumni as $alumnus)
        {
            if($alumnus->longtitude != '')
            {
               $mapDetails[] = array(
                'lat' => (double)$alumnus->latitude,
                'lng' => (double)$alumnus->longtitude,
                );
            }
            else{

            }

        }
        return response()->json($mapDetails);
    }
}
