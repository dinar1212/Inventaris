<?php

namespace App\Models;

use App\Models\Data_barang;
use App\Models\Pengembalian;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data_peminjaman extends Model
{
    use HasFactory;
    // public $fillable = ['kode_peminjam','barang_id','nama_peminjam', 'tanggal_pinjam','jumlah','tanggal_kembali','contact'];
    // membuat fitur created_at(kapan data dibuat) & updated_at (kapan data diedit)
    // aktif
    public $timestamps = true;

    // public function data_barang()
    // {
    //     // data dari model 'Wali' bisa dimilikiv
    //     // oleh model 'Siswa' melalui 'id_siswa'
    //     return $this->belongsTo(Data_barang::class, 'id_data_barang');
    // }
    protected $table = 'data_peminjamen';
    public function barang()
    {
        // 'barang_id'
        return $this->belongsTo(Data_barang::class);
    }
    public function pengembalian()
    {
     
        return $this->hasMany(Pengembalian::class);
    }

}
