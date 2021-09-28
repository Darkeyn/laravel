<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }

    public function fileadd(Request $request){
        return response()->json([
            'message'=>"ok"
        ]);
        

    }
}
