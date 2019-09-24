<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{

    public function showTransactionsInPeriod(Request $request)
    {
		if(!$request->hasHeader('startDate') && !$request->hasHeader('endDate')) {
			
			//$resp = 'no dates ' . $request->hasHeader('startDate');
			return response()->json(Transaction::all(),200);
        }
		else {
			
			$response = Transaction::where('transactionDate','>=',$request->header('startDate'))
				->where('transactionDate','<',$request->header('endDate'))
				->orderBy('transactionDate', 'desc')
				->get();
			return response()->json($response,200);
		}
        
    }

    public function create(Request $request)
    {
        $transaction = Transaction::create($request->all());

        return response()->json($author, 201);
    }

    public function update($id, Request $request)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->update($request->all());

        return response()->json($author, 200);
    }

    public function delete($id)
    {
        Author::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
	
    public function showVendorPackages()
    {
		// $it = new RecursiveDirectoryIterator("C:\xampp\synapi\vendor");
		//$display = Array ( 'jpeg', 'jpg' );
		// foreach(new RecursiveIteratorIterator($it) as $file)
		// {
			// if (strpos($file, '.json') !== false)
				// $resp[] = $file;
		// } 
		$path = "C:\\xampp\\synapi\\vendor";
		$files =[];
		$resp =[];
		$this->outputFiles($path);
		return response()->json($files,200);
    }

	public function outputFiles($path){
		// Check directory exists or not
		if(file_exists($path) && is_dir($path)){
			// Search the files in this directory
			
			$files = glob($path ."/*");
			if(count($files) > 0){
				// Loop through retuned array
				foreach($files as $file){
					if(is_file("$file") && (mb_strtolower(basename($file)) == 'composer.json')){
						
						$resp[] = basename($file);
						$strJsonFileContents = file_get_contents($file);
						$array = json_decode($strJsonFileContents, true);
						//echo " <b> ".basename($file) . " </b> : ";
						if (isset($array["name"])){
							echo $array["name"] . "\n";
						}
						
					} else if(is_dir("$file")){
						// Recursively call the function if directories found
						$this->outputFiles("$file");
					}
				}
			} 
		} 
	}

}