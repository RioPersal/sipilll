@extends('dashboard.master')
@section('judul','Tambah Data Kelas')
@section('content')
<div class="card">
    <form class="form-horizontal" form action="{{url ('/data-kelas/create/{akademik:id}')}}" method="POST">
        <div class="card-body">
            @csrf
            <input type="hidden" name="id" value="#">
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
                    <input type="text" class="form-control @error('nama_kelas') is-invalid  @enderror" name="nama_kelas" value="{{ old('nama_kelas') }}" placeholder="Nama Kelas">
                    @error('nama_kelas')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Mata Kuliah</label>
                <div class="col-sm-10">
                    <select name="id_matkul" class="form-control @error('id_matkul') is-invalid  @enderror">
                        <option value="">- pilih -</option>
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
            <button type="submit" class="btn btn-outline-primary">Tambah</button>
            <a href="/data-kelas" class="btn btn-outline-secondary ml-1">Close</a>
        </div>
    </form>
</div>


@endsection
