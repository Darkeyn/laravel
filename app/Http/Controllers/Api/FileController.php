<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }

    public function fileadd(Request $request){
        
        try{
            if($request->hasFile('ssh')){
                $file = $request->file('ssh');
                // $file_name = time().'.'.$file->getClientOriginalName();
                // $file->move(public_path('ssh'), $file_name);
                $path = Storage::disk('public')->put('ssh', $file);
                return response()->json([
                    asset("storage/$path")
                ], 200);
            }
        }catch(\Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }

    }

    public function filedel($ssh){
        
        try{
            
            unlink(storage_path('app\\public\\ssh\\'.$ssh));

            return response()->json([
                'message' => "File deleted"
            ]);

        }catch(\Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }

    }
}
