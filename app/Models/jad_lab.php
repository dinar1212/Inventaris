<?php

namespace App\Models;

use App\Models\Kel_lab;
use App\Models\Ket_lab;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jad_lab extends Model
{
    use HasFactory;
    // public $fillable = ['nama','hari','tanggal','jam','ket_lab','no_lab','kegiatan','tanggal_berakhir','keterangan'];
    // membuat fitur created_at(kapan data dibuat) & updated_at (kapan data diedit)
    // aktif
    public $guarded = ['id'];

    public function ket_lab()
    {
        return $this->belongsTo(Ket_lab::class, 'id');
    }
    public function kel_lab()
    {
        return $this->belongsTo(Kel_lab::class, 'id');
    }

}
