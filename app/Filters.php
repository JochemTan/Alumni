<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use App\Alumnus;


class Filters
{
    //searchs for values from a premade array to see if the exist
    public static function getArray()
    {
//        $supportedFilters =['name','location','email','education','function','graduationYear'];
//        $supportedFiltersDutch =['Naam','Locatie','Email','Opleiding','Functie','Afstudeerjaar'];
//        $returnArray = [];
//        $anyFilterSet = false;
//        foreach($supportedFilters as $filterKey => $filter){
//            if(isset($_GET[$filter])){
//                $anyFilterSet = true;
//                $returnArray[$filter] = ["checked",$supportedFiltersDutch[$filterKey]];
//            }
//            else{
//                $returnArray[$filter] = [null,$supportedFiltersDutch[$filterKey]];
//            }
//        }
//        //if there isn't any $filter set
//        if(!$anyFilterSet){
//            foreach($supportedFilters as $filterKey => $filter){
//
//                    $returnArray[$filter] = ["checked",$supportedFiltersDutch[$filterKey]];
//            }
//        }

        return ['name', 'location', 'education', 'function', 'graduationYear'];
    }

//returns a string with html code to create all the neccesary filters
    public static function Display()
    {
        $returnString = '
        <div>
            <dl>
                <dt>Voorbeeld</dt>
                <dd style="max-width:600px">
                    Vind de alumni die nu in Flevoland of Noord-Holland wonen en tussen 2001 en 2009 afgestuurd zijn en ook met een voornaam met de letter T hebben:
                </dd><br>
                <dd>
                    <code  style="width:100%"> Flevoland +Noord-Holland 2001-2009 firstname:t</code> 
                </dd> 
            </dl>
            <table id="filter_table" class="table table-hover">
                <thead>
                    <tr>
                        <th>Soort</th>
                        <th>Type</th>
                        <th>Term</th>
                        <th>Voorbeeld</th>
                    </tr>
                </thead>
                <tbody>            
                    <tr>
                        <td>zoeken</td>
                        <td>voeg resultaten toe</td>
                        <div style="visibility: hidden"> +</div>
                        <td><code> +zoekterm</code></td>
                        <td><code>limburg +flevoland</code></td>
                    </tr>               
                    <tr>
                        <td>naam</td>
                        <td>naam</td>
                        <td><code> name:</code></td>
                        <td><code>name:tom</code></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>voornaam</td>
                        <td><code> firstname:</code></td>
                        <td><code>firstname:tom</code></td>
                    </tr>  
                    <tr>
                        <td>locatie</td>
                        <td>locatie</td>
                        <td><code> location:</code></td>
                        <td><code>location:almere</code></td>
                    </tr> 
                    <tr>
                        <td></td>
                        <td>provincie</td>
                        <td><code> province:</code></td>
                        <td><code>province:flevoland</code></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>stad</td>
                        <td><code> place:</code></td>
                        <td><code>place:almere</code></td>
                    </tr>
                     <tr>
                        <td>afstudeerjaar</td> 
                        <td>jaar</td> 
                        <td><code> graduationYear:</code></td> 
                        <td><code>graduationYear:2000</code></td>
                    </tr>
                    <tr>
                        <td></td> 
                        <td>periode</td> 
                        <td><code> jaar-jaar</code></td> 
                        <td><code>2000-2011</code></td>
                    </tr>
                    <tr>
                        <td>opleiding</td> 
                        <td>opleiding</td> 
                        <td><code> education:</code></td> 
                        <td><code>education:Software Development</code></td>
                    </tr>
                </tbody>
            </table>
            <p class="text-info .text-center">
                Klik op de tabel om die term meteen te gebruiken.
            </p>
        </div>
        ';
        return $returnString;
    }

//returns a string to paste in the url
    public static function String()
    {
        $returnString = "";
        if (isset($_GET['searchTerm'])) {
            $returnString = $returnString . 'searchTerm=' . $_GET["searchTerm"] . '&';
        }
        if (isset($_GET['province'])) {
            $returnString = $returnString . 'province=' . $_GET["province"] . '&';
        }
//        $filterArray = self::getArray();
//        foreach($filterArray as $fName=>$fValue){
//            if(isset($fValue[0])) {
//                $returnString = $returnString . $fName . '=' . $fValue[0] . '&';
//            }
//        }
        return rtrim($returnString, "&");
    }

    public static function StringNoSearchTerm()
    {
        $returnString = "";
//        $filterArray = self::getArray();
//        foreach($filterArray as $fName=>$fValue){
//            if(isset($fValue[0])) {
//                $returnString = $returnString . $fName . '=' . $fValue[0] . '&';
//            }
//        }

        return rtrim($returnString, "&");
    }


}
