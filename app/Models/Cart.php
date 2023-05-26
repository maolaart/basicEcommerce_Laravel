<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function member()
    {
        return $this->belongsTo(Member::class,'id_member','id');
    }
    public function produk()
    {
        return $this->belongsTo(Produk::class,'id_barang','id');
    }
}
