@extends('dashboard.master')
@section('judul','Edit Data Pemetaan Matkul dan CPMK')
@section('content')
<div class="card">
  <div class="card-body">
    <form class="form-horizontal" form action="/pemetaan-matkul-dan-cpmk/edit/{matkulind:id}" method="POST">
        @csrf
            <input type="hidden" name="id_matkul" value="{{ old('id_matkul', $matkul->id) }}">

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Matkul</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{ $matkul->nama_matkul }}" disabled style="background-color: #ffffff; color: #333;">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">SKS</label>
                <div class="col-sm-1">
                    <input type="text" class="form-control text-center" value="{{ $matkul->sks }}" disabled style="background-color: #ffffff; color: #333;">
                </div>
            </div>
            <hr>
            <br>

            @foreach ($cepeel as $cpl)
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">{{ $cpl->kode_cpl }}</label>
                    <div class="col-sm-10">
                        <h6 class="text-bold mt-1">{{ $cpl->keterangan }}</h6>
                    </div>
                </div>
                @foreach ($indikator->where('id_cpl', $cpl->id) as $ind)
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">{{ $ind->indikator }}</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" value="{{ $ind->ket_indikator }}" disabled style="background-color: #ffffff; color: #333;">
                        </div>

                        @if ($matkul_ind->where('id_indikator', $ind->id)->count() == 0)
                            <div class="form-check d-flex align-items-center ml-5">
                                <input class="form-check-input" name="id_indikator[]" type="checkbox" value="{{ $ind->id }}">
                            </div>
                            <div class="col-sm-1">
                                <input class="form-control" name="bobot_indikator[]" type="text" placeholder="Bobot">
                            </div>
                        @else
                            @foreach($matkul_ind->where('id_indikator', $ind->id) as $matdin)
                                <div class="form-check d-flex align-items-center ml-5">
                                    <input class="form-check-input" name="id_indikator[]" type="checkbox" value="{{ $ind->id }}" {{ old('id_indikator[]', $ind->id) == $matdin->id_indikator ? 'checked' : '' }}>
                                </div>
                                <div class="col-sm-1">
                                    <input class="form-control" name="bobot_indikator[]" value="{{ old('bobot_indikator[]', $matdin->bobot_indikator) }}" type="text" placeholder="Bobot">
                                </div>
                            @endforeach
                        @endif
                    </div>
                @endforeach
                <hr>
                <br>
            @endforeach

        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary">Edit</button>
            <a href="/pemetaan-matkul-dan-cpmk" class="btn btn-outline-secondary ml-1">Close</a>
        </div>
    </form>
</div>


@endsection
