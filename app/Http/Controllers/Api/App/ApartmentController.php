<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApartmentController extends BaseController
{
    public function index()
    {
        $apartments = Apartment::paginate(2);
        $data = [];

        foreach($apartments as $apartment){

            $data[] = [
                'id' => $apartment->id,
                'name' => $apartment['name_'.app()->getLocale()],
                'description' => $apartment['description_'.app()->getLocale()],
                'price' => $apartment->price,
                'address' => $apartment['address_'.app()->getLocale()],
                'image' => $apartment->image,


            ];
        }
        return $this->sendResponse($data);
    }
    public function show($id){
        $apartment = Apartment::find($id);
        if(is_null($apartment)){
            return $this->sendResponse('Apartment not found.' , 404);
        }
        $data = [
            'id' => $apartment->id,
            'name' => $apartment['name_'.app()->getLocale()],
            'description' => $apartment['description_'.app()->getLocale()],
            'price' => $apartment->price,
            'category_id' => $apartment->category_id,
            'compound_id' => $apartment->compound_id,
            // 'user_id' => $apartment->user_id,
            'address' => $apartment['address_'.app()->getLocale()],
            'image' => $apartment->image,
            'category' => [
                'id' => $apartment->category->id,
                'name' => $apartment->category['name_'.app()->getLocale()],
                'image' => $apartment->category->image,

                'created_at' => $apartment->category->created_at,
                'updated_at' => $apartment->category->updated_at,
            ],
            // 'compound' => $apartment->compound,
            'compound' => [
                'id' => $apartment->compound->id,
                'name' => $apartment->compound['name_'.app()->getLocale()],
                'image' => $apartment->compound->image,
            ],
            // 'user' => $apartment->user,
            'area' => $apartment['area_'.app()->getLocale()],
            'delivery_in' => $apartment->delivery_in,
            'bedrooms' => $apartment->bedrooms,
            'living_rooms' => $apartment->living_rooms,
            'kitchen' => $apartment->kitchen,
            'balcony' => $apartment->balcony,
            'pool' => $apartment->pool,
            'garden' => $apartment->garden,
            'security' => $apartment->security,
            'parking' => $apartment->parking,
            'rooms' => $apartment->rooms,
            'bathrooms' => $apartment->bathrooms,
            'garage' => $apartment->garage,
            'floor' => $apartment->floor,
            'status' => $apartment->status,
            'type' => $apartment->type,
            'location' => $apartment['location_'.app()->getLocale()],
            'latitude' => $apartment->latitude,
            'longitude' => $apartment->longitude,
            'images' => $apartment->images,
        ];
        return $this->sendResponse($apartment);

    }
    public function store(Request $request){
        $vaild = Validator::make($request->all(),[
            'name_en' => 'required',
            'name_ar' => 'required',
            'address_en'=> 'required',
            'address_ar'=> 'required',
            'description_en' => 'required',
            'description_ar' => 'required',
            'price' => 'required',
            'category_id' => 'required|exists:categories,id',
            'compound_id' => 'required|exists:compounds,id',
            'user_id' => 'required|exists:users,id',
            'image' => 'required',
            'area' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'zone'=> 'required',

        ]);
        if($vaild->fails()){
            return $this->sendResponse($vaild->errors()->all(),400);
        }

        $apartment = Apartment::create($request->all());
        return $this->sendResponse($apartment);
    }
    public function update(Request $request,$id){
        $apartment = Apartment::find($id);
        $apartment->update($request->all());
        return $this->sendResponse($apartment,'Apartment Updated');
    }
    public function destroy($id){
        $apartment = Apartment::find($id);
        if(is_null($apartment)){
            return $this->sendResponse('Apartment not found.' , 404);
        }
        $apartment->delete();
        return $this->sendResponse($apartment);
    }
    public function getApartmentsByCategoryId(Request $request){
        $vaild = validator::make($request->all() , [
            'category_id' =>'required',
        ]);
        if($vaild->fails()){
            return $this->sendResponse($vaild->errors()->all(),400);
        }
        $category_id = $request['category_id'];
        $apartments = Apartment::where('category_id',$category_id)->get();
        $data = [];
        foreach($apartments as $apartment){
            $data[] = [
                'id' => $apartment->id,
                'name' => $apartment['name_'.app()->getLocale()],
                'description' => $apartment['description_'.app()->getLocale()],
                'price' => $apartment->price,
                'address' => $apartment['address_'.app()->getLocale()],
                'image' => $apartment->image,
            ];
        }
        return $this->sendResponse($data);
    }


}
