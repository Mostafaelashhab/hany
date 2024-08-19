<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Featured;
use Illuminate\Http\Request;

class FeaturedController extends BaseController
{
    public function index(){
        $app = Featured::all();
        $data = [];
        foreach($app as $item){
            $data = [
                'id'=>$item->apartment['id'],
                'name'=>$item->apartment['name_'.app()->getLocale()],
                'image'=>$item->apartment['image'],
                'price'=>$item->apartment['price'],
                'area'=>$item->apartment['area'],
            ];
        }
        return $this->sendResponse($data);
    }
    public function store(Request $request){
        $vaild = Validator($request->all(),[
            'apartment_id'=>'required|exists:apartments,id',
        ]);
        if($vaild->fails()){
            return $this->sendResponse($vaild->errors()->all() , 400);
        }
        $featured = new Featured();
        $featured->apartment_id = $request->apartment_id;
        $featured->save();
        return $this->sendResponse($featured);
        }
     public function update(Request $request , $id){
        $featured = Featured::find($id);
        $featured->apartment_id = $request->apartment_id;
        $featured->save();
        return $this->sendResponse($featured);
    }
    public function delete($id){
        $featured = Featured::find($id);
        $featured->delete();
        return $this->sendResponse($featured);
    }
    }

