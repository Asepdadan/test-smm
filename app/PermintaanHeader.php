<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermintaanHeader extends Model
{
    protected $table = "permintaan_headers";
    protected $guarded = [];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id', 'id')->withDefault();
    }

    public function details()
    {
        return $this->hasMany(PermintaanDetail::class, 'permintaan_header_id', 'id');
    }

    public function getDetailAttribute($value)
    {
        return $this->details()->count();
    }
}
