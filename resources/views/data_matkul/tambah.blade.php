@extends('dashboard.master')
@section('judul','Tambah Data Mata Kuliah')
@section('content')
<div class="card">
    <form class="form-horizontal" form action="{{url ('/data-mata-kuliah/create')}}" method="POST">
        <div class="card-body">
            @csrf
            <input type="hidden" name="id" value="#">

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kode Matkul</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('kode_matkul') is-invalid  @enderror" name="kode_matkul" value="{{ old('kode_matkul') }}" placeholder="Kode Matkul">
                    @error('kode_matkul')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Matkul</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('nama_matkul') is-invalid  @enderror" name="nama_matkul" value="{{ old('nama_matkul') }}" placeholder="Nama Matkul">
                    @error('nama_matkul')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>


            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Semester</label>
                <div class="col-sm-10">
                    <select name="semester" class="form-control @error('semester') is-invalid  @enderror">
                        <option value="">- pilih -</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        
                    </select>
                    @error('semester')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">SKS</label>
                <div class="col-sm-10">
                    <select name="sks" class="form-control @error('sks') is-invalid  @enderror">
                        <option value="">- pilih -</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        
                    </select>
                    @error('sks')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>


        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-outline-primary">Tambah</button>
            <a href="/data-mata-kuliah" class="btn btn-outline-secondary ml-1">Close</a>
        </div>
    </form>
</div>


@endsection
