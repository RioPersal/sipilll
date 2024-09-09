@extends('dashboard.master')
@section('judul','Tambah Data Informasi RPS')
@section('content')
<div class="card">
    <form class="form-horizontal" form action="{{url ('/rps/{matkul:id}/create_info_rps')}}" method="POST">
        <div class="card-body">
            @csrf
            <input type="hidden" name="id_matkul" value="{{ old('id_matkul', $matkul->id) }}">

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Matkul</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{ $matkul->nama_matkul }}" disabled style="background-color: #ffffff; color: #333;">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Deskripsi singkat</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('deskripsi') is-invalid  @enderror" name="deskripsi" value="{{ old('deskripsi') }}" placeholder="Deskripsi singkat Mata Kuliah">
                    @error('deskripsi')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div id="inputContainer">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Bahan Kajian 1</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('kajian') is-invalid  @enderror" name="kajian[]" value="{{ old('kajian') }}" placeholder="Bahan Kajian 1">
                        @error('kajian')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
    
            <button type="button" id="addButton" class="btn btn-outline-success">Tambah Bahan Kajian</button>

            <div id="inputContainer2">
                <div class="form-group row mt-3">
                    <label class="col-sm-2 col-form-label">Refrensi 1</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('refrensi') is-invalid  @enderror" name="refrensi[]" value="{{ old('refrensi') }}" placeholder="Refrensi 1">
                        @error('refrensi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
    
            <button type="button" id="addButton2" class="btn btn-outline-success">Tambah Refrensi</button>

        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-outline-primary">Tambah</button>
            <a href="{{url('/rps/'.$matkul->id)}}" class="btn btn-outline-secondary ml-1">Close</a>
        </div>
    </form>
</div>


@endsection
@section('js')
<script>
    var count = 2;
    document.getElementById('addButton').addEventListener('click', function() {
      var inputContainer = document.getElementById('inputContainer');
      var newInput = document.createElement('div');
      newInput.className = 'form-group row';
      newInput.innerHTML = `
        <label class="col-sm-2 col-form-label">Bahan Kajian ` + count + `</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('kajian') is-invalid  @enderror" name="kajian[]" value="{{ old('kajian') }}" placeholder="Bahan Kajian ` + count + `">
                    @error('kajian')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
      `;
      inputContainer.appendChild(newInput);
      count++;
    });
</script>
<script>
    var count2 = 2;
    document.getElementById('addButton2').addEventListener('click', function() {
      var inputContainer2 = document.getElementById('inputContainer2');
      var newInput2 = document.createElement('div');
      newInput2.className = 'form-group row';
      newInput2.innerHTML = `
        <label class="col-sm-2 col-form-label">Refrensi ` + count2 + `</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('refrensi') is-invalid  @enderror" name="refrensi[]" value="{{ old('refrensi') }}" placeholder="Refrensi ` + count2 + `">
                    @error('refrensi')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
      `;
      inputContainer2.appendChild(newInput2);
      count2++;
    });
</script>
  
@endsection