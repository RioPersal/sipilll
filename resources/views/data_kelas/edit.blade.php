@extends('dashboard.master')
@section('judul','Edit Data Kelas')
@section('content')
<div class="card">
  <div class="card-body">
    <form class="form-horizontal" form action="/data-kelas/edit/{{$kelas->id}}" method="POST">
        @csrf
            <input type="hidden" name="id" value="{{ old('id', $kelas->id) }}">
            <input type="hidden" name="id_tahunakademik" value="{{ old('id_tahunakademik', $tahunakademiks->id) }}">

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tahun Akademik</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{$tahunakademiks->nama_semester}}  {{$tahunakademiks->tahun_akademik}}" disabled style="background-color: #ffffff; color: #333;">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Kelas</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('nama_kelas') is-invalid  @enderror" name="nama_kelas" value="{{ old('nama_kelas', $kelas->nama_kelas) }}" placeholder="Nama Kelas">
                    @error('nama_kelas')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Matakuliah</label>
                <div class="col-sm-10">
                    <select name="id_matkul" class="form-control @error('id_matkul') is-invalid  @enderror">
                        <option  value="{{ old('id_matkul', $kelas->id_matkul) }}">
                            @foreach($matkuls->where('id', $kelas->id_matkul) as $data)
                            {{ $data->nama_matkul }}
                            @endforeach
                        </option>
                        @foreach ($matkuls as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_matkul }}</option>
                        @endforeach
                    </select>
                    @error('id_matkul')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            

        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary">Edit</button>
            <a href="/data-kelas" class="btn btn-outline-secondary ml-1">Close</a>
        </div>
    </form>
</div>


@endsection
