@extends('dashboard.master')
@section('judul','Edit CPL Prodi')
@section('content')
<div class="card">
  <div class="card-body">
    <form class="form-horizontal" form action="/cpl-prodi/edit/{{$cepeel->id}}" method="POST">
        @csrf
            <input type="hidden" name="id" value="{{ old('id', $cepeel->id) }}">

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kode CPL</label>
                <div class="col-sm-10">
                    <div class="row">
                        
                        <div class="col-2 mr-1">
                            <input type="text" class="form-control @error('kode_cpl') is-invalid  @enderror" name="kode_cpl" value="{{ old('kode_cpl', $cepeel->kode_cpl) }}" placeholder="Kode CPL">
                        </div>
                        @error('kode_cpl')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Keterangan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('keterangan') is-invalid  @enderror" name="keterangan" value="{{ old('keterangan', $cepeel->keterangan) }}" placeholder="Keterangan">
                    @error('keterangan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary">Edit</button>
            <a href="/cpl-prodi" class="btn btn-outline-secondary ml-1">Close</a>
        </div>
    </form>
</div>


@endsection
