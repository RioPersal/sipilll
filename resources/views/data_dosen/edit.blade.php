@extends('dashboard.master')
@section('judul','Edit Data Dosen')
@section('content')
<div class="card">
  <div class="card-body">
    <form class="form-horizontal" form action="/data-dosen/edit/{{$dosen->id}}" method="POST">
        @csrf
            <input type="hidden" name="id" value="{{ old('id', $dosen->id) }}">

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('nama') is-invalid  @enderror" name="nama" value="{{ old('nama', $dosen->nama) }}" placeholder="Nama">
                    @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">NIDN</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('nidn') is-invalid  @enderror" name="nidn" value="{{ old('nidn', $dosen->nidn) }}" placeholder="NIDN">
                    @error('nidn')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Gelar Depan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('gelar_depan') is-invalid  @enderror" name="gelar_depan" value="{{ old('gelar_depan', $dosen->gelar_depan) }}" placeholder="Gelar Depan">
                    @error('gelar_depan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Gelar Belakang</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('gelar_belakang') is-invalid  @enderror" name="gelar_belakang" value="{{ old('gelar_belakang', $dosen->gelar_belakang) }}" placeholder="Gelar Belakang">
                    @error('gelar_belakang')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary">Edit</button>
            <a href="/data-dosen" class="btn btn-outline-secondary ml-1">Close</a>
        </div>
    </form>
</div>


@endsection
