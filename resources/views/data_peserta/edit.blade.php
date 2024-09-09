@extends('dashboard.master')
@section('judul','Edit Data Peserta Kelas')
@section('content')
<div class="card">
  <div class="card-body">
    <form class="form-horizontal" form action="/data-peserta-kelas/edit/{{$peserta->id}}" method="POST">
        @csrf
            <input type="hidden" name="id" value="{{ old('id', $peserta->id) }}">
            <input type="hidden" name="id_kelas" value="{{ old('id_kelas', $peserta->id_kelas) }}">

            @foreach ($kelass->where('id', $peserta->id_kelas) as $item)
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Mata Kuliah</label>

                    <div class="col-sm-10 pl-0">
                        @foreach($matkuls->where('id', $item->id_matkul) as $mtkl)                    
                            <p class="col-sm-10 col-form-label">{{$mtkl->nama_matkul}}</p>
                        @endforeach
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Semester</label>
                    <div class="col-sm-10 pl-0">
                        @foreach($tahunakademiks->where('id', $item->id_tahunakademik) as $thn)
                            <p  class="col-sm-10 col-form-label">{{$thn->nama_semester}}  {{$thn->tahun_akademik}}</p>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Mahasiswa</label>
                <div class="col-sm-10">
                    <select name="id_mahasiswa" class="form-control @error('id_mahasiswa') is-invalid  @enderror">
                        <option value="{{$peserta->id_mahasiswa}}" {{old('id_mahasiswa', $peserta->id_mahasiswa) == $peserta->id ? 'selected' : null}}>
                            @foreach($mahasiswa->where('id', $peserta->id_mahasiswa) as $item )    
                            <p>{{ $item->nama }}</p>
                        @endforeach
                        </option>
                        @foreach ($mahasiswa as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                    </select>
                    @error('id_mahasiswa')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary">Edit</button>
            <a href="javascript:history.back()" class="btn btn-outline-secondary ml-1">Close</a>
        </div>
    </form>
</div>


@endsection
