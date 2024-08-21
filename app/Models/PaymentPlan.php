<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentPlan extends Model
{
    use HasFactory;
    protected $table = 'payment_plans';
    protected $fillable = [
        'advance', //مقدم 
        'monthly', //شهرى 
        'annual', // سنوى
    ];
    public function paymentPlan(){
        return $this->belongsTo(Apartment::class);
    }



}
