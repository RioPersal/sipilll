@extends('dashboard.master')
@section('judul','Edit Data Penilaian Mahasiswa')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col">
            <h5 class="text-bold">{{ $matkul->nama_matkul }}</h5>
            @foreach($tahunakademik->where('id', $kelas->id_tahunakademik) as $item )    
                <b>({{ $matkul->semester }})</b> {{ $item->nama_semester }} {{ $item->tahun_akademik }}
            @endforeach
            <br>  
            {{ $kelas->nama_kelas }}
            <br>
            <a href="/data-penilaian" class="btn btn-sm btn-outline-primary mt-3">Kembali</a>
            </div>
            <right>
                <div class="col">
                    @foreach($mahasiswa->where('id', $peserta->id_mahasiswa) as $item)
                        <h5 class="text-bold">
                            {{ $item->nama }}
                        </h5>  
                        <p class="float-right">{{ $item->nim }}</p>
                    @endforeach
                </div>
            </right>
        </div>
    </div>
  <div class="card-body">
    <form class="form-horizontal" form action="/data-penilaian/{{$kelas->id}}/edit/{{$peserta->id}}" method="POST">
        @csrf
        @foreach ($penilaian as $nilai)
        <input type="hidden" name="id[]" value="{{ old('id', $nilai->id ) }}">
        @endforeach
        <input type="hidden" name="id_kelas" value="{{ old('id_kelas', $kelas->id ) }}">
        <input type="hidden" name="id_mahasiswa" value="{{ old('id_mahasiswa', $mahasiswa->id) }}">
         
        @foreach($cepeel as $cpl)
            <div class="table-responsive">
                <table class="table table-sm table-bordered" style="table-layout:fixed; width: 100%;" >
                    <thead>
                        <tr>
                            <th class="text-center align-middle">{{ $cpl->kode_cpl }}<br>{{ $cpl->keterangan }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($indikator->where('id_cpl',$cpl->id) as $ind)
                            @foreach ($cpmk->where('id_indikator',$ind->id)->where('id_matkul',$matkul->id) as $item)
                                <tr>
                                    <th class="align-middle">{{ $item->kode_cpmk }} ({{ $item->ket_cpmk }})</th>
                                </tr>
                                <tr>
                                    @if ($bobot_cpmk->where('id_cpmk',$item->id)->count() == 0 )
                                    <td class="align-middle text-center">Mohon maaf, data bobot untuk sub-cpmk ini belum tersedia. Harap untuk menginput data bobot terlebih dahulu</td>
                                    @else
                                    <td class="align-middle form-group align-middle">
                                            
                                        
                                    @foreach ($bobot_cpmk->where('id_cpmk',$item->id) as $bobot)
                                    <input type="hidden" name="id_asesmen[]" value="{{ old('id_asesmen', $bobot->id) }}">
                                    <div class="form-group col">
                                                <label class="col-sm col-form-label">
                                                    {{ $bobot->pilihan_asesmen }} ({{ $bobot->bobot_cpmk }}%)
                                                </label>
                                                <div class="col-sm mb-1">
                                                    @foreach ($penilaian->where('id_asesmen',$bobot->id) as $nilai)
                                                    <input type="number" class="form-control @error('nilai') is-invalid  @enderror" name="nilai[]" value="{{ old('nilai',$nilai->nilai) }}" placeholder="Masukkan Nilai">
                                                    @endforeach
                                                    @error('nilai')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                                @endforeach
                                            </td>
                                            @endif
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach

        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-outline-primary">Edit</button>
        <a href="{{url('/data-penilaian/'.$kelas->id)}}" class="btn btn-outline-secondary ml-1">Close</a>
        </div>
    </form>
</div>


@endsection
