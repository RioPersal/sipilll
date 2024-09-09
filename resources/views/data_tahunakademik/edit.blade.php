@extends('dashboard.master')
@section('judul','Edit Data Tahun Akademik')
@section('content')
<div class="card">
  <div class="card-body">
    <form class="form-horizontal" form action="/data-tahun-akademik/edit/{{$tahunakademik->id}}" method="POST">
        @csrf
            <input type="hidden" name="id" value="{{ old('id', $tahunakademik->id) }}">
            
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Semester</label>
                <div class="col-sm-10">
                    <select name="nama_semester" class="form-control @error('nama_semester') is-invalid  @enderror">
                        <option value="{{$tahunakademik->nama_semester}}" {{old('nama_semester', $tahunakademik->nama_semester) == $tahunakademik->id ? 'selected' : null}}>{{$tahunakademik->nama_semester}}</option>
                        <option value="Semester Ganjil">Semester Ganjil</option>
                        <option value="Semester Genap">Semester Genap</option>
                    </select>
                    @error('nama_semester')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tahun Akademik</label>
                <div class="col-sm-2">
                    <input type="text" class="text-center form-control @error('tahun_akademik1') is-invalid  @enderror" name="tahun_akademik1" value="{{ old('tahun_akademik1', $tahun[0]) }}" placeholder="Tahun Akademik">
                    @error('tahun_akademik1')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <h3>/</h3>
                <div class="col-sm-2">
                    <input type="text" class="text-center form-control @error('tahun_akademik2') is-invalid  @enderror" name="tahun_akademik2" value="{{ old('tahun_akademik2', $tahun[1]) }}" placeholder="Tahun Akademik">
                    @error('tahun_akademik2')
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
