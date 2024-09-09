@extends('dashboard.master')
@section('judul','Tambah CPMK')
@section('content')
<div class="card">
  <div class="card-body">
    <form class="form-horizontal" form action="{{url ('/cpmk/create/{indikator:id}')}}" method="POST">
        @csrf
            <input type="hidden" name="id" value="#">
            <input type="hidden" name="id_cpl" value="{{ old('id_cpl', $cepeels->id) }}">

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kode CPL</label>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-3 mr-1">
                            <input type="text" class="form-control" value="{{ $cepeels->kode_cpl }}" disabled style="background-color: #ffffff; color: #333;">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Keterangan CPL</label>
                <div class="col-sm-10">
                    <textarea class="form-control" disabled style="background-color: #ffffff; color: #333;">{{ $cepeels->keterangan }}</textarea>
                </div>
            </div>

            <hr style="border-top: 1px solid">

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kode CPMK</label>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-3 mr-1">
                            <input type="text" class="form-control @error('indikator') is-invalid  @enderror" name="indikator" value="{{ old('indikator') }}" placeholder="Kode CPMK">
                        </div>
                        @error('indikator')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Keterangan CPMK</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('ket_indikator') is-invalid  @enderror" name="ket_indikator" value="{{ old('ket_indikator') }}" placeholder="Keterangan CPMK">
                    @error('ket_indikator')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-outline-primary">Tambah</button>
            <a href="/cpmk" class="btn btn-outline-secondary ml-1">Close</a>
        </div>
    </form>
</div>


@endsection
