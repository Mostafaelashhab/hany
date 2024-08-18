<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compound extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_en',
        'name_ar',
        'image',
        'description_en',
        'description_ar',
        'start_price',
        'max_price',
        'area_en',
        'area_ar',
        'user_id',
        'location_en',
        'location_ar',
        'location_link',
    ];
    public function images(){
        return $this->hasMany(CompoundImage::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

}
