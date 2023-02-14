<?php

namespace App\Models;

use App\Models\jad_lab;
use App\Models\Ket_lab;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use App\Models\Kel_lab;
use Illuminate\Database\Eloquent\Model;

class kel_lab extends Model
{
    use HasFactory;
    // public $fillable = ['no_lab', 'kondisi'];

    // membuat fitur created_at(kapan data dibuat) & updated_at (kapan data diedit)
    // aktif
    public $guarded = [];
    public $timestamps = true;
    public $table = 'kel_labs';

    public function ket_lab()
    {
        return $this->belongsTo(Ket_lab::class, 'ket_id');
    }
    public function jad_lab()
    {
        return $this->hasMany(jad_lab::class, 'id');
    }

}
