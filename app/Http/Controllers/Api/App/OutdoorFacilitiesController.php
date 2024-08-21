<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\OutdoorFacilities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OutdoorFacilitiesController extends BaseController
{
    public function index()
    {
        $outdoor_facilities = OutdoorFacilities::all();
        $data = [];
        foreach ($outdoor_facilities as $outdoor_facility) {
            $data = [
                'id' => $outdoor_facility['id'],
                'name' => $outdoor_facility['name_'.app()->getLocale()],
                'km' => $outdoor_facility['km'],
                'icon' => $outdoor_facility['icon'],
                'apartment_id' => $outdoor_facility['apartment_id'],
            ];
        }
        return $this->sendResponse($outdoor_facilities);
    }
    public function show($id){
        $outdoor_facilities = OutdoorFacilities::find($id);
        if (is_null($outdoor_facilities)) {
            return $this->sendError('Outdoor Facilities not found.');
        }
        return $this->sendResponse($outdoor_facilities->toArray(), 'Outdoor Facilities retrieved successfully.');

    }
    public function store(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'name_en' =>'required',
            'name_ar' =>'required',
            'km'=>'required',
            'apartment_id' =>'required|exists:apartments,id',
        ]);
        if($validator->fails()){
            return $this->sendResponse($validator->errors()->all() , 400);
        }
        $outdoor_facilities = OutdoorFacilities::create($input);
        return $this->sendResponse($outdoor_facilities);
    }
    public function update(Request $request, OutdoorFacilities $outdoor_facilities){
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' =>'required',
            'icon' =>'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $outdoor_facilities->name = $input['name'];
        $outdoor_facilities->icon = $input['icon'];
        $outdoor_facilities->save();
        return $this->sendResponse($outdoor_facilities->toArray(), 'Outdoor Facilities updated successfully.');
    }
    public function destroy(OutdoorFacilities $outdoor_facilities){
        $outdoor_facilities->delete();
        return $this->sendResponse($outdoor_facilities->toArray(), 'Outdoor Facilities deleted successfully.');
    }
    public function get_outdoor_facilities_by_apartment_id($id){
        $outdoor_facilities = OutdoorFacilities::where('apartment_id', $id)->get();
        if (is_null($outdoor_facilities)) {
            return $this->sendError('Outdoor Facilities not found.');
        }
        return $this->sendResponse($outdoor_facilities->toArray(), 'Outdoor Facilities retrieved successfully.');
    }
}
