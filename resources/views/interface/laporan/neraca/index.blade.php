@extends('layouts.app')

@section('content')
<div class="section-header">
    <h1>Laporan Neraca</h1>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{ route('laporan-neraca.results') }}" method="GET">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <input type="date" name="dari" class="form-control" required>
                            </div>
                            <div class="col-2 d-flex align-items-center justify-content-center">
                                <p class="text-center mb-0">S / D</p>
                            </div>
                            <div class="col-5">
                                <input type="date" name="sampai" class="form-control" required>
                            </div>
                        </div>
                        <div class="mt-3 d-flex justify-content-center">
                            <button type="submit" class="btn btn-lg btn-primary">Tampilkan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @if ($is_search)
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card">
                <div class="card-header align-items-center justify-content-center">
                    <div class="text-center" style="flex: 1">
                        <h3>PT. SAPUTRA TIRTHA AMERTHA</h3>
                        <h4>Jalan Kecumbung No. 38</h4>
                    </div>
                    <div class="card-header-action">
                        <form action="{{route('laporan-neraca.export')}}" method="POST">
                            @csrf
                            <input hidden type="date" name="dari" value="{{$dari}}">
                            <input hidden type="date" name="sampai" value="{{$sampai}}">

                            <button type="submit" class="btn btn-icon btn-warning"><i class="fas fa-file-download" style="font-size: 18px"></i></button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th>
                                                <h5>Aktiva</h5>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="d-inline-block ml-5">Kas</span>
                                            </td>
                                            <td></td>
                                            <td align="right">{{$kas}}</td>
                                        </tr>
                                        @foreach ($assets as $a)
                                        <tr>
                                            <td>
                                                <span class="d-inline-block ml-5">{{$a->nama_aset}}</span>
                                            </td>
                                            <td></td>
                                            <td align="right">{{$a->biaya_akuisisi}}</td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td>Total aktiva</td>
                                            <td></td>
                                            <td align="right">{{$aktiva}}</td>
                                        </tr>
                                        <tr style="border-top: 1px solid grey;">
                                            <th>
                                                <h5>Pasiva</h5>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="d-inline-block ml-5">Kewajiban</span>
                                            </td>
                                            <td></td>
                                            <td align="right">{{$beban}}</td>
                                        </tr>
                                        <tr>
                                            <th>
                                                <h5>Ekuitas</h5>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="d-inline-block ml-5">Modal</span>
                                            </td>
                                            <td></td>
                                            <td align="right">{{$modal}}</td>
                                        </tr>
                                        <tr>
                                            <td>Total pasiva</td>
                                            <td></td>
                                            <td align="right">{{$pasiva}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <p>Belum ada data</p>
    @endif
</div>
@endsection
