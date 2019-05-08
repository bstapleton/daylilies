<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plantss;
use Session;

/**
 * Class ImportController
 * @package App\Http\Controllers
 */
class ImportController extends Controller
{
    public function upload() {
        return view('index');
    }

    public function uploadFile(Request $request){

        if ($request->input('submit') != null ){

            $file = $request->file('file');

            // File Details
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize();
            $mimeType = $file->getMimeType();

            // Valid File Extensions
            $valid_extension = array("csv");

            // 2MB in Bytes
            $maxFileSize = 2097152;

            // Check file extension
            if(in_array(strtolower($extension),$valid_extension)){

                // Check file size
                if($fileSize <= $maxFileSize){

                    // File upload location
                    $location = 'uploads';

                    // Upload file
                    $file->move($location,$filename);

                    // Import CSV to Database
                    $filepath = public_path($location."/".$filename);

                    // Reading file
                    $file = fopen($filepath,"r");

                    $importData_arr = array();
                    $i = 0;

                    while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                        $num = count($filedata );

                        for ($c=0; $c < $num; $c++) {
                            $importData_arr[$i][] = $filedata [$c];
                        }
                        $i++;
                    }
                    fclose($file);

                    // Insert to MySQL database
                    foreach($importData_arr as $importData){

                        $insertData = array(
                            "id"=>$importData[0],
                            "name"=>$importData[1],
                            "slug"=>$importData[2],
                            "year_added"=>$importData[3],
                            "type"=>$importData[4],
                            "breeder"=>$importData[5],
                            "breeder_slug"=>$importData[6],
                            "year_bred"=>$importData[7],
                            "description"=>$importData[8],
                            "height"=>$importData[9],
                            "flower_size"=>$importData[10],
                            "genome"=>$importData[11],
                            "foliage"=>$importData[12],
                            "season"=>$importData[13],
                            "price"=>$importData[14],
                            "in_stock"=>$importData[15],
                            "quantity_in_stock"=>$importData[16],
                        );
                        Plantss::insertData($insertData);

                    }

                    Session::flash('message','Import Successful.');
                }else{
                    Session::flash('message','File too large. File must be less than 2MB.');
                }

            }else{
                Session::flash('message','Invalid File Extension.');
            }

        }

        // Redirect to index
        return redirect()->action('PlantController@index');
    }
}
