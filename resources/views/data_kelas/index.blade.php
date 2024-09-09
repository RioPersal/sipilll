@extends('dashboard.master')
@section('judul','Data Kelas')
@section('content')
<form form action="/data-kelas" method="GET">
    <div class="row align-items-center ml-1 mb-3">
      <div class="col-4">
        <div class="row">
            <select class="form-control form-control-sm" name="akademik" onchange="this.form.submit()">
                <option value="">All Categories</option>
                @foreach($akademik as $a)
                    <option value="{{ $a->id }}"  {{ request('akademik') == $a->id ? 'selected' : '' }}>
                        {{$a->nama_semester}}  {{$a->tahun_akademik}}
                    </option>
                @endforeach
            </select>
        </div>
      </div>
      <div class="col-auto">
        <a href="{{url('/data-tahun-akademik/create/')}}" class="btn btn-sm btn-outline-success ml-1" title="Tambah Data Tahun Akademik"><i class="fa-regular fa-square-plus"></i></a>
      </div>
    </div>
</form>
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col">
                <h5 class="text-bold mt-2">List Kelas {{$tahunakademiks->nama_semester}}  {{$tahunakademiks->tahun_akademik}}</h5>
            </div>
            <right>
                <div class="col">
                    <a href="{{url('/data-kelas/create/'.$tahunakademiks->id)}}" class="btn btn-sm btn-outline-success" title="Tambah Data Kelas"><i class="fa-regular fa-square-plus"></i></a>
                </div>
            </right>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-sm table-bordered">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Kelas</th>
                    <th class="text-center">Mata Kuliah</th>
                    <th class="text-center">Dosen</th>
                    <th class="text-center">Tahun Akademik</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if($kelas->count() == 0)
                    <tr>
                        <td class="text-center" colspan="6">
                            Data kelas belum tersedia, harap tambah data kelas terlebih dahulu!
                        </td>
                    </tr>
                @else
                    @foreach ($kelas as $key => $value)
                    <tr>
                        <td class="text-center align-middle">{{ $loop->iteration }}</td>
                        <td class="text-center align-middle">{{$value->nama_kelas}}</td>
                        
                        @foreach($matkuls->where('id', $value->id_matkul) as $mtkl)
                            <td class="text-center align-middle">{{$mtkl->nama_matkul}}</td>
                            @foreach ($pengampu->where('id_matkul',$mtkl->id) as $peng)
                                @php
                                    $p = explode(',',$peng->id_pengampu);
                                @endphp
                                <td>
                                @foreach($p as $data_array)
                                @foreach($dosens->where('id',$data_array) as $item )    
                                    <p>- @if (isset($item->gelar_depan))
                                        {{$item->gelar_depan}}.    
                                        @endif
                    
                                        {{$item->nama}}
                    
                                        @if (isset($item->gelar_belakang))
                                        {{$item->gelar_belakang}}
                                        @endif</p>
                                @endforeach
                            @endforeach
                                </td>
                            @endforeach
                        @endforeach

                        @foreach($akademik->where('id', $value->id_tahunakademik) as $thn)
                            <td class="text-center align-middle">{{$thn->nama_semester}}  {{$thn->tahun_akademik}}</td>
                        @endforeach
                        <td class="col-2 text-center align-middle">
                            <a href="/data-kelas/edit/{{$value->id}}" class="btn btn-sm btn-outline-warning" title="Edit Kelas"><i class="fa fa-edit"></i></a>
                            <a href="/data-peserta-kelas/{{$value->id}}" class="btn btn-sm btn-outline-info ml-1" title="Tampilkan Peserta Kelas"><i class="fa fa-eye"></i></a>
                            <form action="/data-kelas/{{$value->id}}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger ml-1" onclick="return confirm('apa kamu yakin ingin menghapus data tersebut?')" title="Hapus Kelas"><i class = "fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>

        </table>
    </div>
</div>
@endsection
