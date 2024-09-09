@extends('dashboard.master')
@section('judul','Rekap Mata Kuliah')
@section('content')
<div class="card">
  <div class="card-body">
    @foreach($tahunakademiks as $data)
    <h3>{{ $data->nama_semester }} {{ $data->tahun_akademik }}</h3>
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
                @foreach($kelass->where('id_tahunakademik', $data->id) as $key => $kls)
                @php
                    $x = explode(",", $kls->id_dosen);
                @endphp

                @if (in_array((string)$dosen->id, $x))
                @foreach($matkuls->where('id', $kls->id_matkul) as $item)
                <tr>
                    <td class="text-center align-middle">{{ $key+1 }}</td>
                    <td class="text-center align-middle">{{ $kls->nama_kelas }}</td>
                    <td class="text-center align-middle">{{ $item->nama_matkul }}</td>
                    <td class="text-center align-middle">{{ $item->semester }}</td>
                    <td class="text-center align-middle">{{ $item->sks }}</td>
                    <td class="text-center align-middle">
                        <a class="btn btn-sm col btn-outline-info" href="{{url('/rekap-mata-kuliah/'.$kls->id)}}"><i class="fa fa-eye"></i>Tampilkan</a>
                    </td>
                </tr>
                @endforeach
                @endif
                    
                @endforeach
                </tbody>
            </table>
    </div>
    <hr>
    <br>
    @endforeach
  </div>
</div>
@endsection
