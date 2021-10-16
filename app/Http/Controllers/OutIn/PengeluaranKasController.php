<?php

namespace App\Http\Controllers\Outin;

use App\Http\Controllers\Controller;
use App\Models\DataAkun;
use App\Models\DataKategori;
use App\Models\DataProyek;
use App\Models\PengeluaranKas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengeluaranKasController extends Controller
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
        $pengeluarans = PengeluaranKas::with('dataakun', 'kategori')->latest()->get();

        return view('interface.out-in.pengeluaran-kas', compact('pengeluarans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $akuns      = DataAkun::all();
        $kategories = DataKategori::all();

        return view('interface.out-in.add-pengeluaran-kas', compact('akuns', 'kategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = [
            'id_user'                => Auth::user()->id,
            'id_akun'                => $request->id_akun,
            'id_kategori'            => $request->id_kategori,
            'keterangan_pengeluaran' => $request->keterangan_pengeluaran,
            'tanggal_pengeluaran'    => $request->tanggal_pengeluaran,
            'jumlah'                 => $request->jumlah,
        ];

        $getKategori = DataKategori::find($request->id_kategori);
        $getHarga    = $getKategori->harga_satuan;
        $fields['total_pengeluaran'] = $getHarga * $request->jumlah;

        PengeluaranKas::create($fields);

        return redirect()->route('pengeluaran-kas.index')->with('success', 'Data Pengeluaran ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pengeluarans = PengeluaranKas::find($id);
        $akuns        = DataAkun::all();
        $kategories   = DataKategori::all();

        return view('interface.out-in.edit-pengeluaran-kas', compact('pengeluarans', 'akuns', 'kategories'));
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
        $pengeluarans = PengeluaranKas::find($id);

        $fields = [
            'id_user'                => Auth::user()->id,
            'id_akun'                => $request->id_akun,
            'id_kategori'            => $request->id_kategori,
            'keterangan_pengeluaran' => $request->keterangan_pengeluaran,
            'tanggal_pengeluaran'    => $request->tanggal_pengeluaran,
            'jumlah'                 => $request->jumlah,
        ];

        $getKategori = DataKategori::find($request->id_kategori);
        $getHarga    = $getKategori->harga_satuan;
        $fields['total_pengeluaran'] = $getHarga * $request->jumlah;

        $pengeluarans->update($fields);
        return redirect()->route('pengeluaran-kas.index')->with('success', 'Data Pengeluaran berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}