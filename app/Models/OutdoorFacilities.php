<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutdoorFacilities extends Model
{
    use HasFactory;
    protected $table = 'outdoor_facilities';
    protected $fillable = [
        'id',
        'name_en',
        'name_ar',
        'icon',
        'km',
        'apartment_id'
    ];

    public function outdoor_apartment(){
        return $this->belongsTo(Apartment::class);
    }
}
