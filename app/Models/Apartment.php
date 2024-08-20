<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name_en',
        'name_ar',
        'address_en',
        'address_ar',
        'image',
        'description_en',
        'description_ar',
        'price',
        'area',
        'delivery_in',
        'compound_id',
        'category_id',

        'user_id',
        'bedrooms',
        'living_rooms',
        'kitchen',
        'balcony',
        'pool',
        'garden',
        'security',
        'parking',
        'rooms',
        'bathrooms',
        'garage',
        'floor',
        'status',
        'type',
        'zone',
        'latitude',
        'longitude',
    ];
    public function compound(){
        return $this->belongsTo(Compound::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function parent_cat(){
        return $this->belongsTo(ParentCat::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function images(){
        return $this->hasMany(ApartmentImage::class , 'apartment_id');
    }
    public function OutdoorFacilities(){
        return $this->hasMany(OutdoorFacilities::class, 'apartment_id');
    }
    public function ApartmentType(){
        return $this->belongsTo(ApartmentType::class, 'type_id');
    }
    public function ApartmentStatus(){
        return $this->hasMany(ApartmentStatus::class, 'apartment_id');
    }

    public function Featureds(){
        return $this->hasMany(Apartment::class, 'apartment_id');
    }

}
