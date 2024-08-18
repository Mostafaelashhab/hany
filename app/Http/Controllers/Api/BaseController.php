<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class BaseController extends Controller
{

    public function sendResponse($data , $code = 200)
    {
       return response()->json(['data'=>$data],$code);
}
}
