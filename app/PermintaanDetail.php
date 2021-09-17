<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermintaanDetail extends Model
{
    protected $table = "permintaan_details";
    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::updated(function($model)
        {
            $barang = Barang::find($model->barang_id);
            $total = ($barang->stok - $model->qty);
            $barang->stok = $total;
            $barang->save();
        });
    }
}
