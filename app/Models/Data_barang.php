<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Data_peminjaman;
use App\Models\Data_perbaikan;
use App\Models\Pengembalian;

class Data_barang extends Model
{
    use HasFactory;
    // public $fillable = ['kode_barang','nama_barang', 'dari_lab','status','kondisi','asal_barang','harga'];
    // membuat fitur created_at(kapan data dibuat) & updated_at (kapan data diedit)
    // aktif

    public $timestamps = true;
    // membuat relasi one to one
    // public function Data_peminjaman()
    // {
    //     // data dari model 'Siswa' bisa memiliki 1 data
    //     // dari model 'Data_peminjaman' melalui id_siswa
    //     return $this->hasOne(Data_peminjaman::class, 'id_data_barang');
    // }

    public function peminjaman()
    {
        return $this->hasMany(Data_peminjaman::class);
    }
    public function pengembalian()
    {
        return $this->hasMany(pengembalian::class);
    }

    public function perbaikan()
    {
        return $this->hasMany(Data_perbaikan::class);
    }
    
    public static function boot()
    {
    parent::boot();
    self::deleting(function($var) {
        if($var->peminjaman->count() > 0){
            // Alert::error('failed',
            // 'Data gabisa dihapus');
            return false;
        }    
    });
}
// parent controller
// method destroy(){
//     if (!Data_barang::destroy($id)){
//         return redirect()->back();
//     }
}

