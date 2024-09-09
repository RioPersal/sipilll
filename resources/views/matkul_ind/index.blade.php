@extends('dashboard.master')
@section('judul','Matkul VS Indikator')
@section('css')
<style>
.table-responsive {
  overflow-x: auto;
  border-right: 1px solid #ddd; /* Tambahkan border kanan ke kontainer */
  white-space: nowrap; /* Menjaga teks tidak terbungkus */
}

.table {
  white-space: nowrap; /* Menjaga teks tidak terbungkus */
  border-collapse: collapse; /* Menggabungkan border tabel */
}

.table th, .table td {
  border: 1px solid #ddd; /* Border tabel */
}

</style>
@endsection
@section('content')
{{-- matkul-vs-indikator-sks --}}
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col">
                <h5 class="m-0">@yield('judul') (SKS)</h5>
            </div>
            <right>
            <div class="col mr-1">
                <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-default" title="Import Data Pemetaan Matkul dan CPMK"><i class="fas fa-file-arrow-up"></i></button>

                <div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Import Data Pemetaan Matkul dan CPMK</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ url('/pemetaan-matkul-dan-cpmk/import') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="excel_file">Upload Excel File</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="excel_file" name="excel_file" accept=".xls,.xlsx">
                                            <label class="custom-file-label" for="excel_file">Choose file</label>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary">Import</button>
                                        <button type="button" class="btn btn-default ml-1" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </right>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-sm table-bordered">
            <thead>
                <tr>
                    <th class="text-center align-middle" rowspan="2">No</th>
                    <th class="text-center align-middle" rowspan="2">Nama Mata Kuliah</th>
                    <th class="text-center align-middle" rowspan="2">SKS</th>
                    <th class="text-center align-middle" rowspan="2">SMTR</th>
                    @php
                        $count = 0;
                    @endphp
                    @foreach ($cepeel as $head_cpl)
                        @php
                            $count_colspan = $indikator->where('id_cpl', $head_cpl->id)->count();
                            $count = $count + $count_colspan;

                        @endphp
                        <th class="text-center" colspan="{{ $count_colspan }}">{{ $head_cpl->kode_cpl }}</th>
                    @endforeach
                    <th class="text-center align-middle" rowspan="2">Aksi</th>
                </tr>

                <tr>
                    @foreach ($cepeel as $head_cpl2)
                        @foreach ($indikator->where('id_cpl', $head_cpl2->id) as $head_indikator2)
                            <th class="text-center">{{ $head_indikator2->indikator }}</th>
                        @endforeach
                    @endforeach
                </tr>
            </thead>

            <tbody>
                @foreach ($matkul as $key => $value)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{$value->nama_matkul}}</td>
                    <td class="text-center">{{$value->sks}}</td>
                    <td class="text-center">{{$value->semester}}</td>
                    @if ($matkul_ind->where('id_matkul', $value->id)->count() == 0)
                        <td class="text-center" colspan="{{ $count }}">Mohon maaf, data pemetaan cpmk untuk matkul ini belum tersedia. Harap untuk menginput data pemetaan cpmk terlebih dahulu</td>
                    @else
                    
                    @foreach ($cepeel as $cpl)
                        @foreach ($indikator->where('id_cpl', $cpl->id) as $ind)
                        
                        @if ($matkul_ind->where('id_matkul', $value->id)->where('id_indikator', $ind->id)->count() == 0)
                        <td class="text-center"></td>
                        @else
                        @foreach ($matkul_ind->where('id_matkul', $value->id)->where('id_indikator', $ind->id) as $item)
                            <td class="text-center">{{ $item->bobot_indikator }}</td>
                        @endforeach
                        @endif
                        @endforeach
                    @endforeach
                    @endif
                    <td class="text-center align-middle">
                        @if ($matkul_ind->where('id_matkul', $value->id)->count() == 0)
                        <a href="{{url('/pemetaan-matkul-dan-cpmk/create/'.$value->id)}}" class="btn btn-sm btn-outline-success" title="Tambah Data Pemetaan Matkul dan CPMK"><i class="fa fa-plus"></i></a>
                            
                        @else
                        <a href="{{url('/pemetaan-matkul-dan-cpmk/edit/'.$value->id)}}" class="btn btn-sm col btn-outline-warning" title="Edit Data Pemetaan Matkul dan CPMK"><i class="fa fa-edit"></i></a>
                            
                        @endif
                      </td>
                </tr>
                @endforeach
            </tbody>
          <tfoot>
            <tr>
                <th class="text-center align-middle" rowspan="2">No</th>
                <th class="text-center align-middle" rowspan="2">Nama Mata Kuliah</th>
                <th class="text-center align-middle" rowspan="2">SKS</th>
                <th class="text-center align-middle" rowspan="2">SMTR</th>
                

                @foreach ($cepeel as $head_cpl2)
                    @foreach ($indikator->where('id_cpl', $head_cpl2->id) as $head_indikator2)
                        <th class="text-center">{{ $head_indikator2->indikator }}</th>
                    @endforeach
                @endforeach
                <th class="text-center align-middle" rowspan="2">Aksi</th>
            </tr>

            <tr>
                @foreach ($cepeel as $head_cpl)
                    @php
                        $count_colspan = $indikator->where('id_cpl', $head_cpl->id)->count();
                    @endphp
                    <th class="text-center" colspan="{{ $count_colspan }}">{{ $head_cpl->kode_cpl }}</th>
                @endforeach
            </tr>
          </tfoot>
        </table>
        </div>
    </div>
</div>


{{-- matkul-vs-indikator-bobot --}}
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col">
                <h5 class="m-0">@yield('judul') (Bobot)</h5>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-sm table-bordered">
            <thead>
                <tr>
                    <th class="text-center align-middle" rowspan="2">No</th>
                    <th class="text-center align-middle" rowspan="2">Nama Mata Kuliah</th>
                    <th class="text-center align-middle" rowspan="2">SKS</th>
                    <th class="text-center align-middle" rowspan="2">SMTR</th>
                    @php
                        $count = 0;
                    @endphp
                    @foreach ($cepeel as $head_cpl)
                        @php
                            $count_colspan = $indikator->where('id_cpl', $head_cpl->id)->count();
                            $count = $count + $count_colspan;
                        @endphp
                        <th class="text-center" colspan="{{ $count_colspan }}">{{ $head_cpl->kode_cpl }}</th>
                    @endforeach
                </tr>

                <tr>
                    @foreach ($cepeel as $head_cpl2)
                        @foreach ($indikator->where('id_cpl', $head_cpl2->id) as $head_indikator2)
                            <th class="text-center">{{ $head_indikator2->indikator }}</th>
                        @endforeach
                    @endforeach
                </tr>
            </thead>

            <tbody>
                @foreach ($matkul as $key => $value)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{$value->nama_matkul}}</td>
                    <td class="text-center">{{$value->sks}}</td>
                    <td class="text-center">{{$value->semester}}</td>
                    @if ($matkul_ind->where('id_matkul', $value->id)->count() == 0)
                        <td class="text-center" colspan="{{ $count }}">Mohon maaf, data pemetaan cpmk untuk matkul ini belum tersedia. Harap untuk menginput data pemetaan cpmk terlebih dahulu</td>
                    @else
                    
                    @foreach ($cepeel as $cpl)
                        @foreach ($indikator->where('id_cpl', $cpl->id) as $ind)
                        
                        @if ($matkul_ind->where('id_matkul', $value->id)->where('id_indikator', $ind->id)->count() == 0)
                        <td class="text-center"></td>
                        @else
                        @foreach ($matkul_ind->where('id_matkul', $value->id)->where('id_indikator', $ind->id) as $item)
                        @php
                            $q = 100/$value->sks;
                            $bobot = $q * $item->bobot_indikator;
                        @endphp
                            <td class="text-center">{{ round($bobot, 2) }}</td>
                        @endforeach
                        @endif
                        @endforeach
                    @endforeach
                    @endif
                </tr>
                @endforeach
            </tbody>
          <tfoot>
            <tr>
                <th class="text-center align-middle" rowspan="3" colspan="4">Total</th>
                
                @foreach ($cepeel as $footer_cpl)
                    @foreach ($indikator->where('id_cpl', $footer_cpl->id) as $key => $footer_indikator)
                    @php
                        $a = 0;
                    @endphp
                        @foreach ($matkul as $mtkl)
                        @foreach ($matkul_ind->where('id_matkul', $mtkl->id)->where('id_indikator', $footer_indikator->id) as $item)
                            
                            @php
                                $x = 100/$mtkl->sks;
                                $a += $x*$item->bobot_indikator;
                            @endphp
                        @endforeach
                        @endforeach    
                        <th class="text-center">{{ round($a, 2) }}</th>
                    @endforeach
                @endforeach
            </tr>

            <tr>
                

                @foreach ($cepeel as $head_cpl2)
                    @foreach ($indikator->where('id_cpl', $head_cpl2->id) as $head_indikator2)
                        <th class="text-center">{{ $head_indikator2->indikator }}</th>
                    @endforeach
                @endforeach
            </tr>

            <tr>
                @foreach ($cepeel as $head_cpl)
                    @php
                        $count_colspan = $indikator->where('id_cpl', $head_cpl->id)->count();
                    @endphp
                    <th class="text-center" colspan="{{ $count_colspan }}">{{ $head_cpl->kode_cpl }}</th>
                @endforeach
            </tr>
          </tfoot>
        </table>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
        var fileName = e.target.files[0].name;
        var label = document.querySelector('.custom-file-label');
        label.textContent = fileName;
    });
    </script>
@endsection