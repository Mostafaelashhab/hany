<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Featured;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeaturedController extends BaseController
{
    public function index ()
    {

            $featured = Featured::all();
             return $this->sendResponse($featured);
      }
      public function show($id){
        $featured = Featured::find($id);
         if (is_null($featured)) {
            return $this->sendResponse('Featured not found.' , 404);
        }
        $data = Apartment::find($featured->apartment_id);
        $datas = [
            'id' => $data->id,
            'name' => $data['name_'.app()->getLocale()],
            'price' => $data->price,
            'image' => $data->image,
            'address' => $data['address_'.app()->getLocale()],
            'area' => $data->area,
            'bedrooms' => $data->bedrooms,
            'bathrooms' => $data->bathrooms,
            'garages' => $data->garages,
            'description' => $data['description_'.app()->getLocale()],
                ];
             return $this->sendResponse($featured);
      }
      public function store(Request $request){
        $vaild = Validator::make($request->all() , [
            'apartment_id' => 'required|exists:apartments,id',
        ]);
        if ($vaild->fails()) {
            return $this->sendResponse($vaild->errors()->all() , 400);
        }
        $featured = Featured::create($request->all());
        return $this->sendResponse($featured);
      }
      public function update(Request $request, Featured $featured){
        $featured->update($request->all());
        return $this->sendResponse($featured);
      }
}


