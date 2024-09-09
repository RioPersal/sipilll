@extends('dashboard.master')
@section('judul','Edit Data Bobot CPMK')
@section('content')
<div class="card">
    <form class="form-horizontal" form action="{{url ('/sub-cpmk/{matkul:id}/edit_bobot/{cpmk:id}')}}" method="POST">
        <div class="card-body">
            @csrf
            <input type="hidden" name="id_matkul" value="{{ old('id_matkul', $matkul->id) }}">
            <input type="hidden" name="id_cpmk" value="{{ old('id_cpmk', $cpmk->id) }}">

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Matkul</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{ $matkul->nama_matkul }}" disabled style="background-color: #ffffff; color: #333;">
                </div>
            </div>

            @foreach ($cepeel as $cpl)
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">{{ $cpl->kode_cpl }}</label>
                    <div class="col-sm-10">
                        <textarea type="text" class="form-control" disabled style="background-color: #ffffff; color: #333;">{{ $cpl->keterangan }}</textarea>
                    </div>
                </div>
                
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">{{ $indikator->indikator }}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ $indikator->ket_indikator }}" disabled style="background-color: #ffffff; color: #333;">
                        </div>
                    </div>
                
            @endforeach
            
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kode CPMK</label>
                <div class="col-sm-10">
                    <div class="row">
                        
                        <div class="col-3 mr-1">
                            <input type="text" class="form-control" value="{{ $cpmk->kode_cpmk }}" disabled style="background-color: #ffffff; color: #333;">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Keterangan CPMK</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{ $cpmk->ket_cpmk }}" disabled style="background-color: #ffffff; color: #333;">
                </div>
            </div>

            <hr>

            @foreach ($bobot_cpmk as $bobot)
            
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Pilih Asesmen</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control @error('indikator_asesmen') is-invalid  @enderror" name="indikator_asesmen[]" value="{{ old('indikator_asesmen', $bobot->indikator_asesmen) }}" placeholder="Indikator Asesmen">
                    @error('indikator_asesmen')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-sm-2">
                    <select name="pilihan_asesmen[]" class="form-control @error('pilihan_asesmen') is-invalid  @enderror">
                        <option value="{{$bobot->pilihan_asesmen}}" {{old('pilihan_asesmen', $bobot->pilihan_asesmen) == $bobot->id ? 'selected' : null}}>{{$bobot->pilihan_asesmen}}</option>
                        <option value="Quiz">Quiz</option>
                        <option value="Tugas Mandiri">Tugas Mandiri</option>
                        <option value="Tugas Kelompok">Tugas Kelompok</option>
                        <option value="Pratikum">Pratikum</option>
                        <option value="UTS">UTS</option>
                        <option value="UAS">UAS</option>
                    </select>
                    @error('pilihan_asesmen')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                
                <div class="col-sm-1">
                    <input type="text" class="form-control @error('bobot_cpmk') is-invalid  @enderror" name="bobot_cpmk[]" value="{{ old('bobot_cpmk', $bobot->bobot_cpmk) }}" placeholder="Bobot Asesmen (%)">
                    @error('bobot_cpmk')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-sm-2">
                    <button type="button" class="btn btn-outline-danger btn-hapus">Hapus</button>
                </div>
            </div>
            @endforeach
            <div id="inputContainer">
            </div>
                            

            

        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-outline-primary">Edit</button>
            <a href="{{url('/sub-cpmk/'.$matkul->id)}}" class="btn btn-outline-secondary ml-1">Close</a>
        </div>
    </form>
</div>


@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $('.btn-hapus').click(function() {
      $(this).closest('.form-group').remove();
    });
  });
</script>>
  
@endsection
