<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\DataCustomer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DataCustomerController extends Controller
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
        $datas = DataCustomer::all();
        return view('interface.master-data.data-customer', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('interface.master-data.add-data-customer');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'id_customer' => 'required|unique:data_customers',
            'nama_customer' => 'required|regex:/^[\pL\s\-]+$/u',
            'no_telpon' => 'required|numeric',
            'alamat' => 'required',
        ])->validate();

        $fields = [
            'id_customer' => $request->id_customer,
            'nama_customer' => $request->nama_customer,
            'no_telpon' => $request->no_telpon,
            'alamat' => $request->alamat,
        ];

        DataCustomer::create($fields);
        return redirect()->route('data-customer.index')->with('success', 'Data Pelanggan berhasil ditambahkan');
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
        $data = DataCustomer::find($id);
        return view('interface.master-data.edit-data-customer', compact('data'));
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
        $data = DataCustomer::find($id);

        Validator::make($request->all(), [
            'nama_customer' => 'required|regex:/^[\pL\s\-]+$/u',
            'no_telpon' => 'required|numeric|digits_between:11,13',
            'alamat' => 'required',
        ])->validate();

        $fields = [
            'id_customer' => $data->id_customer,
            'nama_customer' => $request->nama_customer,
            'no_telpon' => $request->no_telpon,
            'alamat' => $request->alamat,
        ];

        $data->update($fields);
        return redirect()->route('data-customer.index')->with('success', 'Data Pelanggan berhasil diubah');
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
