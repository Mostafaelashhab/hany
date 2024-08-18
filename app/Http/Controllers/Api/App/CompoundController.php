<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Compound;
use Illuminate\Http\Request;

class CompoundController extends BaseController
{

    public function index()
    {
        $compounds = Compound::all();
        $data = [];
        foreach($compounds as $compound){
            $data[] = [
                'id' => $compound->id,
                'name' => $compound['name_'.app()->getLocale()],
                'image' => $compound->image,
                'description' => $compound['description_'.app()->getLocale()],
                'start_price' => $compound->start_price,
                'max_price' => $compound->max_price,
                'area' => $compound['area_'.app()->getLocale()],
                'user_id' => $compound->user_id,
                'location' => $compound['location_'.app()->getLocale()],
                'location_link' => $compound->location_link,
                'user' => $compound->user,
                'images' => $compound->images,
            ];
        }
        return $this->sendResponse($data);
    }
    public function show($id){
        $compound = Compound::find($id);
            $data = [
                'id' => $compound->id,
                'name' => $compound['name_'.app()->getLocale()],
                'image' => $compound->image,
                'description' => $compound['description_'.app()->getLocale()],
                'start_price' => $compound->start_price,
                'max_price' => $compound->max_price,
                'area' => $compound['area_'.app()->getLocale()],
                'user_id' => $compound->user_id,
                'location' => $compound['location_'.app()->getLocale()],
                'location_link' => $compound->location_link,
                'user' => $compound->user,
                'images' => $compound->images,
            ];
        return $this->sendResponse($data);
    }
    public function store(Request $request){
        $compound = Compound::create($request->all());
        return $this->sendResponse($compound );
    }
    public function update(Request $request , $id){
        $compound = Compound::find($id);
        $compound->update($request->all());
        return $this->sendResponse($compound , 'Compound Updated');
    }
    public function destroy($id){
        $compound = Compound::find($id);
        $compound->delete();
        return $this->sendResponse($compound , 'Compound Deleted');
    }

}
