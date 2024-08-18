<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\ApartmentImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApartmentImageController extends BaseController
{
        public function index()
    {

        $images = ApartmentImage::all('id' , 'image', 'apartment_id');


        return $this->sendResponse($images);
    }
    public function show($id){
        $images = ApartmentImage::where('apartment_id', $id)->get();
        return $this->sendResponse($images);

    }
        public function store(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'apartment_id' => 'required',
                'image' => 'required',
            ]);
            if($validator->fails()){
                return $this->sendResponse($validator->errors()->all() , 400);
            }

                $image = ApartmentImage::create($request->all());
                return $this->sendResponse($image);
        }
}
