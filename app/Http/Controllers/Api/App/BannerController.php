<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Api\BaseController;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BannerController extends BaseController
{
    public function index()
    {
        $banners = Banner::all();
        return $this->sendResponse($banners);
    }
    public function show($id){
        $banner = Banner::find($id);
        return $this->sendResponse($banner);
    }
    public function store(Request $request){
        $vaild = Validator::make($request->all(),[
            'image' => 'required|image|mimes:png,jpg,jpeg,gif,svg',
        ]);
        if($vaild->fails()){
            return $this->sendResponse($vaild->errors()->all(),400);
        }
        $banner = Banner::create($request->all());
        return $this->sendResponse($banner);
    }
    public function update(Request $request , $id){
        $banner = Banner::find($id);
        $banner->update($request->all());
        return $this->sendResponse($banner);
    }

    public function destroy($id){
        $banner = Banner::find($id);
        $banner->delete();
        return $this->sendResponse($banner);
    }

}
