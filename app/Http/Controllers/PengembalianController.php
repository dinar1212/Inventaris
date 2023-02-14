<?php

namespace App\Http\Controllers;

// use App\Models\Pengembalian;
use App\Models\Data_peminjaman;
// use App\Models\Data_barang;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use DB;

class PengembalianController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    
    // }
    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    public function index()
    {
        
        // $pengembalian = Data_peminjaman::where('status','Dikembalikan')->get();
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
        // $data_barangs = Data_barang::all();
        // return view('pengembalian.create',compact('data_barangs'));
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
            // 'nama_peminjam' => 'required',
            // 'barang_id' => 'required',
            // 'tanggal_pinjam' => 'required',
           
            
          
        ]);
        // $pengembalian->kode_peminjam = $data_peminjaman->kode_peminjam;
        // $pengembalian->nama_peminjam = $request->nama_peminjam;
        // $pengembalian->barang_id = $request->barang_id;
        // $pengembalian->tanggal_pinjam = $request->tanggal_pinjam;
        $pengembalian->tanggal_kembali = now()->format('Y-m-d H:i:s');      
       
       

        $pengembalian =  new Pengembalian();
        // $pengembalian->nama_peminjam =$request->nama_peminjam;
        // $pengembalian->barang_id =$request->barang_id;
        // $pengembalian->tanggal_pinjam =$request->tanggal_pinjam;    
        $pengembalian->tanggal_kembali = now()->format('Y-m-d H:i:s');      
        $pengembalian->save();
      
        // $pengembalian = new Pengembalian::findOrFail($pengembalian->laporan_id);
        // // // $pengembalian->status='checkout';
        // // $pengembalian->save();
        $pengembalian->save();
        return redirect()->route('pengembalian.index')
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
        $pengembalian = Pengembalian::findOrFail($id);
        return view('pengembalian.show', compact('pengembalian'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);
        return view('pengembalian.edit', compact('pengembalian'));
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
        //     'kode_peminjam' => 'required',
        //     'nama_peminjam' => 'required',
        //     'nama_barang' => 'required',
        //     'tanggal_pinjam' => 'required',
           
            'tanggal_kembali' => 'required',
            
        
        ]);

        $pengembalian = Pengembalian::findOrFail($id);
       
        // $pengembalian->nama_peminjam = $request->nama_peminjam;
        // $pengembalian->nama_barang = $request->nama_barang;
        // $pengembalian->tanggal_pinjam = $request->tanggal_pinjam;
        $pengembalian->tanggal_kembali = now()->format('Y-m-d H:i:s');      
        $pengembalian->save();
        return redirect()->route('pengembalian.index')
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
        $pengembalian = Pengembalian::findOrFail($id);
        $pengembalian->delete();
        return redirect()->route('pengembalian.index')
            ->with('success', 'Data berhasil dihapus!');
    }
}
