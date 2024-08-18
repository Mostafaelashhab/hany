<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Category extends Model
{
    use HasFactory , HasApiTokens;
    protected $fillable = [
        'id',
        'name_en',
        'name_ar',
        'image',
        'parent_id'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function apartment(){
        return $this->belongsTo(Apartment::class);
    }
    public function parent_cat(){
        return $this->belongsTo(ParentCat::class , 'parent_id');
    }

}
