<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function order()
    {
        return $this->belongsTo(Order::class,'id_order','id');
    }

    public function member()
    {
        return $this->belongsTo(Payment::class,'id_order','id');
    }
}
