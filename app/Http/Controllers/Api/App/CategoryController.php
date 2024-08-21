<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    public function index(){
        $categories = Category::all('id','name_'.app()->getLocale() , 'image','parent_id');
        $data = [];
foreach ($categories as  $category) {

        $data[] = [
            'id' => $category['id'],
            'name' => $category['name_'.app()->getLocale()],
            'image' => $category['image'],
            'parent_id'=> [
                'name' => $category->parent_cat['name_'.app()->getLocale()] ,
                'description' => $category->parent_cat['description_'.app()->getLocale()] ,
                'image' => $category->parent_cat['image'] ,
            ]

        ];

}
        return $this->sendResponse($data);
    }
    public function show($id){
        $category = Category::find($id , ['id','name_'.app()->getLocale() , 'image']);
        if($category){
            $data = [
                'id' => $category['id'],
                'name' => $category['name_'.app()->getLocale()],
                'image' => $category['image'],
            ];

            return $this->sendResponse($data);
        }

        return $this->sendResponse('not found',404);
    }
     public function store(Request $request){
        $vaild = validator($request->all(),[
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'parent_id' => 'required|exists:parent_cats,id',
        ]);
        if($vaild->fails()){
            return $this->sendResponse($vaild->errors()->all(),400);
        }
        $category = Category::create($request->all());
        $data = [
            'id' =>$category['id'],
            'name' => $category['name_'.app()->getLocale()],
            'parent' => [
                'name'=> $category->parent_cat['name_'.app()->getLocale()],
                'description'=> $category->parent_cat['description_'.app()->getLocale()],
                'image' =>$category->parent_cat['image'],
            ]
        ];
        return $this->sendResponse($data);
    }
    public function update(Request $request,$id){
        $category = Category::find($id );
         $vaild = validator($request->all(),[
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if($vaild->fails()){
            return $this->sendResponse($vaild->errors(),400);
        }
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'),$imageName);
            $category->image = $imageName;
        }
        if($category){
            $category->update($request->all());
            return $this->sendResponse($category);
        }
        return $this->sendResponse('not found',404);
    }
    public function destroy($id){
        $category = Category::find($id);
        if($category){
            $category->delete();
            return $this->sendResponse('deleted');
        }
        return $this->sendResponse('not found',404);
    }

}
