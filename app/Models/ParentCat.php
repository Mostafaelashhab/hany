<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentCat extends Model
{
    use HasFactory;
        protected $table = 'parent_cats';
        protected $fillable = [
            'id',
            'name_en',
            'name_ar',
            'description_en',
            'description_ar',
        ];
            public function child(){
            return $this->hasMany(Category::class , 'parent_id');
        }
}
