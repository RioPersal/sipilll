@extends('dashboard.master')
@section('judul','Tambah Data Peserta Kelas')
@section('content')
<div class="card">
  <div class="card-body">
    <form class="form-horizontal" form action="{{url ('/data-peserta-kelas/create/{peserta:id}')}}" method="POST">
        @csrf
            <input type="hidden" name="id" value="#">
            <input type="hidden" name="id_kelas" value="{{ old('id_kelas', $kelas->id) }}">

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Mata Kuliah</label>

                <div class="col-sm-10 pl-0">
                    @foreach($matkuls->where('id', $kelas->id_matkul) as $mtkl)                    
                        <p class="col-sm-10 col-form-label">{{$mtkl->nama_matkul}}</p>
                    @endforeach
                </div>
            </div>
            
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Semester</label>
                <div class="col-sm-10 pl-0">
                    @foreach($tahunakademiks->where('id', $kelas->id_tahunakademik) as $thn)
                        <p  class="col-sm-10 col-form-label">{{$thn->nama_semester}}  {{$thn->tahun_akademik}}</p>
                    @endforeach
                </div>
            </div>

            <div id="inputContainer">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Mahasiswa</label>
                    <div class="col-sm-10">
                        <select name="id_mahasiswa[]" class="form-control @error('id_mahasiswa') is-invalid  @enderror">
                            <option value="">- pilih -</option>
                            @foreach ($mahasiswa as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }} ({{ $item->nim }})</option>
                            @endforeach
                        </select>
                        @error('id_mahasiswa')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>

            <button type="button" id="addButton" class="btn btn-outline-success">Tambah Mahasiswa</button>

        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-outline-primary">Tambah</button>
            <a href="javascript:history.back()" class="btn btn-outline-secondary ml-1">Close</a>
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
        <label class="col-sm-2 col-form-label">Mahasiswa</label>
        <div class="col-sm-10">
            <select name="id_mahasiswa[]" class="form-control @error('id_mahasiswa') is-invalid  @enderror">
                <option value="">- pilih -</option>
                @foreach ($mahasiswa as $item)
                    <option value="{{ $item->id }}">{{ $item->nama }} ({{ $item->nim }})</option>
                @endforeach
            </select>
            @error('id_mahasiswa')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
      `;
      inputContainer.appendChild(newInput);
    });
  </script>
  
@endsection