@extends('dashboard.master')
@section('judul','Edit Data Mahasiswa')
@section('content')
<div class="card">
  <div class="card-body">
    <form class="form-horizontal" form action="/data-mahasiswa/edit/{{$mahasiswa->id}}" method="POST">
        @csrf
            <input type="hidden" name="id" value="{{ old('id', $mahasiswa->id) }}">

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('nama') is-invalid  @enderror" name="nama" value="{{ old('nama', $mahasiswa->nama) }}" placeholder="Nama">
                    @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">NIM</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('nim') is-invalid  @enderror" name="nim" value="{{ old('nim', $mahasiswa->nim) }}" placeholder="NIM">
                    @error('nim')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Angkatan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('angkatan') is-invalid  @enderror" name="angkatan" value="{{ old('angkatan', $mahasiswa->angkatan) }}" placeholder="Angkatan">
                    @error('angkatan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary">Edit</button>
            <a href="/data-mahasiswa" class="btn btn-outline-secondary ml-1">Close</a>
        </div>
    </form>
</div>


@endsection
