@extends('dashboard.master')
@section('judul','Tambah Data Bobot CPMK')
@section('content')
<div class="card">
    <form class="form-horizontal" form action="{{url ('/sub-cpmk/{matkul:id}/create_bobot/{cpmk:id}')}}" method="POST">
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

            <div id="inputContainer">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Pilih Asesmen</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control @error('indikator_asesmen') is-invalid  @enderror" name="indikator_asesmen[]" value="{{ old('indikator_asesmen') }}" placeholder="Indikator Asesmen">
                    @error('indikator_asesmen')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-sm-2">
                    <select name="pilihan_asesmen[]" class="form-control @error('pilihan_asesmen') is-invalid  @enderror">
                        <option value="">- pilih -</option>
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

                <div class="col-sm-2">
                    <input type="number" class="form-control @error('bobot_cpmk') is-invalid  @enderror" name="bobot_cpmk[]" value="{{ old('bobot_cpmk') }}" placeholder="Bobot Asesmen">
                    @error('bobot_cpmk')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            </div>

            <button type="button" id="addButton" class="btn btn-outline-success">Tambah Jumlah Asesmen</button>

        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-outline-primary">Tambah</button>
            <a href="{{url('/sub-cpmk/'.$matkul->id)}}" class="btn btn-outline-secondary ml-1">Close</a>
        </div>
    </form>
</div>


@endsection
@section('js')
<script>
    document.getElementById('addButton').addEventListener('click', function() {
      var inputContainer = document.getElementById('inputContainer');
      var newInput = document.createElement('div');
      newInput.className = 'form-group row';
      newInput.innerHTML = `
        <label class="col-sm-2 col-form-label">Pilih Asesmen</label>
        <div class="col-sm-6">
            <input type="text" class="form-control @error('indikator_asesmen') is-invalid  @enderror" name="indikator_asesmen[]" value="{{ old('indikator_asesmen') }}" placeholder="Indikator Asesmen">
                @error('indikator_asesmen')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        <div class="col-sm-2">
            <select name="pilihan_asesmen[]" class="form-control @error('pilihan_asesmen') is-invalid  @enderror">
                <option value="">- pilih -</option>
                <option value="Quiz">Quiz</option>
                <option value="Tugas Mandiri">Tugas Mandiri</option>
                <option value="Tugas Kelompok">Tugas Kelompok</option>
                <option value="Pratikum">Pratikum</option>
                <option value="UTS">UTS</option>
                <option value="UAS">UAS</option>
            </select>
        </div>
        <div class="col-sm-2">
            <input type="number" class="form-control @error('bobot_cpmk') is-invalid  @enderror" name="bobot_cpmk[]" value="{{ old('bobot_cpmk') }}" placeholder="Bobot Asesmen">
        </div>
      `;
      inputContainer.appendChild(newInput);
    });
  </script>
  
@endsection
