<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Auth; 
use JWTAuth;
use File;

class ChapterController extends Controller
{
    //
    public $successStatus = 200;

    /** 
     * chapter start api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function start($id){ 
        $user = JWTAuth::user();
        $file = fopen(public_path("chapter-1.txt"), "r");
        $fileData = File::get(public_path("chapter-1.txt"));
        $fileData = str_replace('[username]', $user->name, $fileData);
        $fileData = utf8_encode($fileData);
        $array = preg_split("/\r\n|\n|\r/", $fileData);
        $array = array_filter($array);
        $array = array_values($array);
        return response()->json([
            'status' => 'success',
            'data' => $array
        ]);
    }
}
