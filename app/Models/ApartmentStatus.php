<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApartmentStatus extends Model
{
    use HasFactory;
    protected $table = 'apartment_statuses';
    protected $fillable = [
        'id',
        'name_en',
        'name_ar',
    ];
    public function apartment(){
        return $this->belongsTo(Apartment::class , 'apartment_id');
    }

}
