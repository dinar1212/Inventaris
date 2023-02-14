<?php

namespace App\Models;

use App\Models\jad_lab;
use App\Models\Kel_lab;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ket_lab extends Model
{
    use HasFactory;
    // public $fillable = ['lantai','jumlah_lab'];
    // // membuat fitur created_at(kapan data dibuat) & updated_at (kapan data diedit)
    // // aktif
    // public $timestamps = true;
    //    public function jad_lab()
    //     {
    //         return $this->hasMany(Jad_lab::class);
    //     }
    protected $table = 'ket_labs';
    public function kel_lab()
    {
        return $this->hasMany(Kel_lab::class);
    }
    public function jad_lab()
    {
        return $this->hasMany(jad_lab::class, 'id_jad_labs');
    }
}
