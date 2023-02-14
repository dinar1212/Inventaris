<?php

namespace App\Models;

// // use App\Models\Data_barang;
use App\Models\Data_peminjaman;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;
    // public $fillable = ['kode_peminjam','barang_id','nama_peminjam', 'tanggal_pinjam','jumlah','tanggal_kembali','contact'];
    // membuat fitur created_at(kapan data dibuat) & updated_at (kapan data diedit)
    // aktif
    public $timestamps = true;

    public function peminjaman()
    {
        // data dari model 'Wali' bisa dimiliki
        // oleh model 'Siswa' melalui 'id_siswa'
        return $this->belongsTo(Data_peminjaman::class, 'peminjaman_id');
    }

    // public function barang()
    // {
    //     return $this->belongsTo(Data_barang::class);
    // }
    // public function peminjaman()
    // {
    //     return $this->hasMany(Data_peminjaman::class, 'peminjaman_id');
    // }

}
