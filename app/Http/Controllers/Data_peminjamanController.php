<?php

namespace App\Http\Controllers;

use App\Models\Data_barang;
use App\Models\Data_peminjaman;
use App\Models\Laporan;
use App\Models\Pengembalian;
use DB;
use Illuminate\Http\Request;

class Data_peminjamanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ->with('barang')
        $pengembalian = Pengembalian::all();
        $data_peminjaman = Data_peminjaman::where('status', 'Dipinjam')->get();
        return view('data_peminjaman.index', compact('data_peminjaman', 'pengembalian'));
    }

    public function Pengembalian()
    {
        $pengembalian = Pengembalian::all();
        return view('pengembalian.index', compact('pengembalian'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data_barangs = Data_barang::all();
        return view('data_peminjaman.create', compact('data_barangs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // 'kode_peminjam' => 'required',
            'nama_peminjam' => 'required',
            'barang_id' => 'required',
            'tanggal_pinjam' => 'required',
            'jumlah' => 'required',
            'status' => 'required',
            'contact' => 'required',

        ]);
        $data_peminjaman = new Data_peminjaman();
        $kode_peminjamans = DB::table('data_peminjamen')->select(DB::raw('MAX(RIGHT(kode_peminjam,3)) as kode'));
        if ($kode_peminjamans->count() > 0) {
            foreach ($kode_peminjamans->get() as $kode_peminjam) {
                $x = ((int) $kode_peminjam->kode) + 1;
                $kode = sprintf("%03s", $x);
            }
        } else {
            $kode = "001";
        }
        $data_peminjaman->kode_peminjam = 'UIN-' . date('dmy') . $kode;
        $data_peminjaman->nama_peminjam = $request->nama_peminjam;
        $data_peminjaman->barang_id = $request->barang_id;
        $data_peminjaman->tanggal_pinjam = $request->tanggal_pinjam;
        $data_peminjaman->jumlah = $request->jumlah;
        $data_peminjaman->status = $request->status;
        $data_peminjaman->contact = $request->contact;
        
        $data_peminjaman->save();

    //     if ($request->tanggal > $request->tanggal_berakhir){
    //         return back()->with('error', 'Invalid');
    //     }

    //     $jad_lab->save();
    //     return redirect()->route('jad_lab.index')
    //     ->with('success', 'Data berhasil dibuat!');
    // }


        $data_barang = Data_barang::findOrFail($data_peminjaman->barang_id);
        if ($data_barang->jumlah < $data_peminjaman->jumlah) {
            return back()->with('error', 'Stok Barang Habis');
            $data_peminjaman = Data_Peminjaman::findOrFail($data_peminjaman->id);
            $data_peminjaman->delete();
            return redirect()
                ->route('data_peminjaman.create')
                ->with('eror', 'Stok Kurang');
        } else {
            $data_barang->jumlah -= $data_peminjaman->jumlah;
        }
        $data_barang->save();

        $laporan = new Laporan();
        $laporan->kode_peminjam = $data_peminjaman->nama_peminjam;
        $laporan->nama_peminjam = $request->nama_peminjam;
        $laporan->barang_id = $request->barang_id;
        $laporan->tanggal_pinjam = $request->tanggal_pinjam;
        $laporan->jumlah = $request->jumlah;
        $laporan->contact = $request->contact;
        $laporan->save();

        //tampil ke pengembalian
        // $pengembalian =  new Pengembalian();

        // // $pengembalian->nama_peminjam =$request->nama_peminjam;
        // $pengembalian->barang_id =$request->barang_id;
        // // $pengembalian->tanggal_pinjam =$request->tanggal_pinjam;
        // $pengembalian->tanggal_kembali = now()->format('Y-m-d H:i:s');

        // $pengembalian->save();

        // $laporan = new Laporan::findOrFail($data_peminjaman->laporan_id);
        // // $laporan->status='checkout';
        // $laporan->save();
        return redirect()->route('data_peminjaman.index')
            ->with('success', 'Data berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data_peminjaman = Data_peminjaman::findOrFail($id);
        return view('data_peminjaman.show', compact('data_peminjaman'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data_peminjaman = Data_peminjaman::findOrFail($id);
        $data_barangs = Data_barang::all();
        return view('data_peminjaman.edit', compact('data_peminjaman', 'data_barangs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            // 'kode_peminjam' => 'required',
            // 'nama_peminjam' => 'required',
            // 'barang_id' => 'required',
            // 'tanggal_pinjam' => 'required',
            // 'jumlah' => 'required',
            'status' => 'required',
            // 'contact' => 'required',

        ]);

        $data_peminjaman = Data_peminjaman::findOrFail($id);
        // $data_peminjaman->kode_peminjam = $request->kode_peminjam;
        // $data_peminjaman->nama_peminjam = $request->nama_peminjam;
        // $data_peminjaman->barang_id = $request->barang_id;
        // $data_peminjaman->tanggal_pinjam = $request->tanggal_pinjam;
        // $data_peminjaman->jumlah = $request->jumlah;
        $data_peminjaman->status = $request->status;
        // $data_peminjaman->contact = $request->contact;

        $data_barang = Data_barang::findOrFail($data_peminjaman->barang_id);
        $data_barang->jumlah += $data_peminjaman->jumlah;
        $data_barang->save();

        $pengembalian = new Pengembalian();
        // $pengembalian->nama_peminjam = $request->nama_peminjam;
        $pengembalian->peminjaman_id =  $data_peminjaman->id;
        // $pengembalian->tanggal_pinjam = $request->tanggal_pinjam;
        $pengembalian->tanggal_kembali = now()->format('Y-m-d H:i:s');
        $pengembalian->save();

        $data_peminjaman->save();

        return redirect()->route('data_peminjaman.index')
            ->with('success', 'Data berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data_peminjaman = Data_peminjaman::findOrFail($id);
        $data_peminjaman->delete();
        return redirect()->route('data_peminjaman.index')
            ->with('success', 'Data berhasil dihapus!');
    }
}
