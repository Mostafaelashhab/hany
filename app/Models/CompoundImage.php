<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompoundImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'compound_id',
        'image',
    ];
    public function compound(){
        return $this->belongsTo(Compound::class);
    }

}
