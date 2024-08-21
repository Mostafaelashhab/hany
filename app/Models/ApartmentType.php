<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApartmentType extends Model
{
    use HasFactory;
    protected $table = 'apartment_types';
    protected $fillable = [
        'id',
        'name_en',
        'name_ar',
    ];
    public function Apartments(){
        return $this->hasMany(Apartment::class , 'type_id');
    }
}
