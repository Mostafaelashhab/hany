<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\ParentCat;
use Illuminate\Http\Request;

class ParentCatController extends BaseController
{
    public function index()
    {
        $parent_cats = ParentCat::all();
        $data = [];
        foreach ($parent_cats as $parent_cat) {
            $data[] = [
                'id' => $parent_cat->id,
                'name' => $parent_cat['name_'. app()->getLocale()],
                'image' => $parent_cat->image,
                'description' => $parent_cat['description_'.app()->getLocale()],
            ];
        }
        return $this->sendResponse($data);
    }
    public function show($id){
        $parent_cat = ParentCat::find($id);
        if(is_null($parent_cat)){
            return $this->sendResponse('not found',404);
        }
        $data = [
            'id' => $parent_cat->id,
            'name' => $parent_cat['name_'. app()->getLocale()],
            'image' => $parent_cat->image,
        ];
        return $this->sendResponse($data);
    }
    public function store(Request $request){
        $vaild = validator($request->all(),[
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
        ]);
        if($vaild->fails()){
            return $this->sendResponse($vaild->errors()->all() , 400);
        }
        $parent_cat = new ParentCat();
        $parent_cat->name_en = $request->name_en;
        $parent_cat->name_ar = $request->name_ar;
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/parent_cats');
            $image->move($destinationPath, $name);
            $parent_cat->image = $name;
        }
        $parent_cat->save();
        return $this->sendResponse('added successfully',200);

}


    public function update(Request $request,$id){
        $parent_cat = ParentCat::find($id);
        $vaild = validator($request->all(),[
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if($vaild->fails()){
            return $this->sendError('error validation', $vaild->errors());
        }
        $parent_cat->name_en = $request->name_en;
        $parent_cat->name_ar = $request->name_ar;
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/parent_cats');
            $image->move($destinationPath, $name);
            $parent_cat->image = $name;
        }
        $parent_cat->save();
        return $this->sendResponse('updated successfully',200);
    }
}

