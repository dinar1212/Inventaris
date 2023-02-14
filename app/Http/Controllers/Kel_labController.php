<?php

namespace App\Http\Controllers;

use App\Models\Kel_lab;
use App\Models\Ket_lab;
// use App\Models\Jad_lab;
use Illuminate\Http\Request;

class Kel_labController extends Controller
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

        $kel_lab = Kel_lab::with('ket_lab')->latest()->get();
        $ket_lab = Ket_lab::all();
        return view('kel_lab.index', compact('kel_lab', 'ket_lab'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kel_labs = Kel_lab::all();
        $ket_labs = Ket_lab::all();
        return view('kel_lab.create', compact('ket_labs'));
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
            'ket_id' => 'required',
            'no_lab' => 'required',
            'kondisi' => 'required',
        ]);
        $kel_lab = new Kel_lab();
        $kel_lab->ket_id = $request->ket_id;
        $kel_lab->no_lab = $request->no_lab;
        $kel_lab->kondisi = $request->kondisi;

        $kel_lab->save();
        return redirect()->route('kel_lab.index')
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
        $kel_lab = Kel_lab::findOrFail($id);
        return view('kel_lab.show', compact('kel_lab'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kel_lab = Kel_lab::findOrFail($id);
        $ket_lab = Ket_lab::all();
        return view('kel_lab.edit', compact('kel_lab', 'ket_lab'));
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
            'ket_id' => 'required',
            'no_lab' => 'required',
            'kondisi' => 'required',
        ]);

        $kel_lab = Kel_lab::findOrFail($id);
        $kel_lab->ket_id = $request->ket_id;
        $kel_lab->no_lab = $request->no_lab;
        $kel_lab->kondisi = $request->kondisi;

        $kel_lab->save();
        return redirect()->route('kel_lab.index')
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
        $kel_lab = Kel_lab::findOrFail($id);
        $kel_lab->delete();
        return redirect()->route('kel_lab.index')
            ->with('success', 'Data berhasil dihapus!');
    }
    public function getKel_lab($id)
    {
        $kel_labs = Kel_lab::where('ket_id', $id)->get();
        return response()->json($kel_labs);
    }
}
