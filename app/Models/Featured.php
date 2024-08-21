<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Featured extends Model
{
    use HasFactory;
    protected $fillable = [
        'apartment_id',
    ];
    public function apartment(){
        return $this->belongsTo(Apartment::class , 'apartment_id');
    }
}
