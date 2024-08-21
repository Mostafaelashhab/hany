<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\CompoundImage;
use Illuminate\Http\Request;

class CompoundImageController extends BaseController
{
    public function index()
    {
        $data = CompoundImage::all();
        return $this->sendResponse($data);
    }
    public function store(Request $request){
        $vaild = validator($request->all(),[
            'image' => 'required',
            'compound_id' => 'required|exists:compounds,id'
        ]);
        if($vaild->fails()){
            return $this->sendResponse($vaild->errors()->all(),400);
        }
        $data = CompoundImage::create($request->all());
        return $this->sendResponse($data);
    }

}
