@extends('dashboard.master')
@section('judul','Tambah CPL Prodi')
@section('content')
<div class="card">
  <div class="card-body">
    <form class="form-horizontal" form action="{{url ('/cpl-prodi/create')}}" method="POST">
        @csrf
            <input type="hidden" name="id" value="#">

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kode CPL</label>
                <div class="col-sm-10">
                    <div class="row">
                        
                        <div class="col-2 mr-1">
                            <input type="text" class="form-control @error('kode_cpl') is-invalid  @enderror" name="kode_cpl" value="{{ old('kode_cpl') }}" placeholder="Kode CPL">
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
                <label class="col-sm-2 col-form-label">Keterangan CPL</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('keterangan') is-invalid  @enderror" name="keterangan" value="{{ old('keterangan') }}" placeholder="Keterangan">
                    @error('keterangan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-outline-primary">Tambah</button>
            <a href="/cpl-prodi" class="btn btn-outline-secondary ml-1">Close</a>
        </div>
    </form>
</div>


@endsection
