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
        // return response()->json([
        //     'message'=>"ok"
        // ]);
        
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

        // $path = Storage::disk('public')->put('txt', $request->file('ssh.txt'));

    }

    public function filedel($ssh){
        // return response()->json([
        //     'message'=>"ok"
        // ]);
        
        try{
            //$file_link = DB::table('projects')->select('ssh')->where('id', '=', $project_id)->first();
            //$rest = substr($file_link, 10);
            //echo($file_link);
            //Storage::disk('public')->delete('ssh', $ssh);
            //Storage::delete($ssh);
            unlink(storage_path('app\\public\\ssh\\'.$ssh));

            return response()->json($ssh);
        }catch(\Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }

        // $path = Storage::disk('public')->put('txt', $request->file('ssh.txt'));

    }
}
