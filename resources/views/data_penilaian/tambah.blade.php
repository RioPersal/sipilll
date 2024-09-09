@extends('dashboard.master')
@section('judul','Tambah Data Penilaian Mahasiswa')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col">
              <h5 class="text-bold">{{ $matkul->nama_matkul }}</h5>
              @foreach($tahunakademik->where('id', $kelas->id_tahunakademik) as $akademik )    
                <b>({{ $matkul->semester }})</b> {{ $akademik->nama_semester }} {{ $akademik->tahun_akademik }}
              @endforeach
              <br>  
              {{ $kelas->nama_kelas }}
              
            </div>
            <right>
                <div class="col">
                    
                        <h5 class="text-bold">
                            {{ $mahasiswa->nama }}
                        </h5>  
                        <p class="float-right">{{ $mahasiswa->nim }}</p>
                    
                </div>
            </right>
        </div>
    </div>
  <div class="card-body">
    <form class="form-horizontal" form action="{{url ('/data-penilaian/{kelass:id}/create/{penilaian:id}')}}" method="POST">
        @csrf
            <input type="hidden" name="id" value="#">
            <input type="hidden" name="id_kelas" value="{{ old('id_kelas', $kelas->id ) }}">
            <input type="hidden" name="id_mahasiswa" value="{{ old('id_mahasiswa', $mahasiswa->id) }}">
             
            @foreach($cepeel as $cpl)
                
                    <table class="table table-sm table-bordered" style="table-layout:fixed; width: 100%;" >
                        <thead>
                            <tr>
                                <th class="text-center align-middle bg-secondary">{{ $cpl->kode_cpl }}<br>{{ $cpl->keterangan }}</th>
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
                                        <div class="form-group row">
                                                    <label class="col-sm-3 text-center col-form-label">
                                                        {{ $bobot->pilihan_asesmen }} ({{ $bobot->bobot_cpmk }}%)
                                                    </label>
                                                    <div class="col-sm mb-1">
                                                        <input type="number" class="form-control @error('nilai') is-invalid  @enderror" name="nilai[]" value="{{ old('nilai') }}" placeholder="Masukkan Nilai">
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
                
            @endforeach
            

        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-outline-primary">Tambah</button>
        <a href="{{url('/data-penilaian/'.$kelas->id)}}" class="btn btn-outline-secondary ml-1">Close</a>
        </div>
    </form>
</div>


@endsection
