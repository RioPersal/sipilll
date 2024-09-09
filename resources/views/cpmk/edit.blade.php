@extends('dashboard.master')
@section('judul','Edit Data CPMK')
@section('content')
<div class="card">
  <div class="card-body">
    <form class="form-horizontal" form action="/sub-cpmk/{matkul:id}/edit/{cpmk:id}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ old('id', $cpmk->id) }}">
        <input type="hidden" name="id_indikator" value="{{ old('id_indikator', $indikator->id) }}">
        <input type="hidden" name="id_matkul" value="{{ old('id_matkul', $matkul->id) }}">

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Nama Matkul</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" value="{{ $matkul->nama_matkul }}" disabled style="background-color: #ffffff; color: #333;">
            </div>
        </div>

        
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">{{ $cepeel->kode_cpl }}</label>
                <div class="col-sm-10">
                    <textarea type="text" class="form-control" disabled style="background-color: #ffffff; color: #333;">{{ $cepeel->keterangan }}</textarea>
                </div>
            </div>
            
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">{{ $indikator->indikator }}</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="{{ $indikator->ket_indikator }}" disabled style="background-color: #ffffff; color: #333;">
                    </div>
                </div>
            
            <hr>
        
        
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Kode CPMK</label>
            <div class="col-sm-10">
                <div class="row">
                    
                    <div class="col-3 mr-1">
                        <input type="text" class="form-control @error('kode_cpmk') is-invalid  @enderror" name="kode_cpmk" value="{{ old('kode_cpmk', $cpmk->kode_cpmk) }}" placeholder="Kode CPMK">
                    </div>
                    @error('kode_cpmk')
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
                <input type="text" class="form-control @error('ket_cpmk') is-invalid  @enderror" name="ket_cpmk" value="{{ old('ket_cpmk', $cpmk->ket_cpmk) }}" placeholder="Keterangan CPMK">
                @error('ket_cpmk')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary">Edit</button>
            <a href="{{url('/sub-cpmk/'.$matkul->id)}}" class="btn btn-outline-secondary ml-1">Close</a>
        </div>
    </form>
</div>


@endsection
