@extends('dashboard.master')
@section('judul','Tambah Penilaian')
@section('content')
<form form action="/data-penilaian" method="GET">
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
    </div>
</form>
<div class="card">
  <div class="card-body">
    
    <h3>{{ $tahunakademiks->nama_semester }} {{ $tahunakademiks->tahun_akademik }}</h3>
    <hr>
    <div class="row">
        
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th class="text-center align-middle">No</th>
                        <th class="text-center align-middle col-2">Kelas</th>
                        <th class="text-center align-middle">Nama Mata Kuliah</th>
                        <th class="text-center align-middle col-1">Semester</th>
                        <th class="text-center align-middle col-1">SKS</th>
                        <th class="text-center align-middle col-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($kelas->where('id_tahunakademik', $tahunakademiks->id) as $key => $kls)
                    @foreach($matkul->where('id', $kls->id_matkul) as $item)
                    <tr>
                        <td class="text-center align-middle">{{ $key+1 }}</td>
                        <td class="text-center align-middle">{{ $kls->nama_kelas }}</td>
                        <td class="text-center align-middle">{{ $item->nama_matkul }}</td>
                        <td class="text-center align-middle">{{ $item->semester }}</td>
                        <td class="text-center align-middle">{{ $item->sks }}</td>
                        <td class="text-center align-middle">
                            <a class="btn btn-sm col btn-outline-info" href="{{url('/data-penilaian/'.$kls->id)}}"><i class="fa fa-eye"></i>Tampilkan</a>
                        </td>
                    </tr>
                    @endforeach
                    
                @endforeach
                </tbody>
            </table>
    </div>
    <hr>
    <br>
    
  </div>
</div>
@endsection
