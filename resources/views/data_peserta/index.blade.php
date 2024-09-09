@extends('dashboard.master')
@section('judul','Data Peserta Kelas')
@section('content')
<div class="card">
  <div class="card-header">
      <div class="row">
            <div class="col">
                <h3>{{ $matkul->nama_matkul }} - {{ $kelas->nama_kelas }}</h3>
                <p>{{ $matkul->kode_matkul }} / {{ $matkul->sks }} sks / Semester {{ $matkul->semester }}</p>
            </div>
          <right>
              <div class="col mr-1">
                <a href="{{url('/data-kelas')}}" class="btn btn-sm btn-outline-primary" title="Kembali"><i class="fa fa-arrow-left"></i></a>
                <a href="{{url('/data-peserta-kelas/create/'.$kelas->id)}}" class="btn btn-sm btn-outline-success ml-1" title="Tambah Peserta Kelas"><i class="fa fa-plus"></i></a>
                <button type="button" class="btn btn-sm btn-outline-success ml-1" data-toggle="modal" data-target="#modal-default" title="Import Data Peserta Kelas"><i class="fas fa-file-arrow-up ml-1"></i></button>

                <div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Import Data Peserta Kelas</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ url('/data-peserta-kelas/import') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="excel_file">Upload Excel File</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="excel_file" name="excel_file" accept=".xls,.xlsx">
                                            <label class="custom-file-label" for="excel_file">Choose file</label>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary">Import</button>
                                        <button type="button" class="btn btn-default ml-1" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
          </right>
      </div>
  </div>
  <div class="card-body">
      <table class="table table-sm table-bordered"
            <thead>
              <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">NIM</th>
                  <th class="text-center">Nama</th>
                  <th class="text-center">Aksi</th>
              </tr>
            </thead>
          <tbody>
            @foreach ($peserta as $key => $value)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                @foreach ($mahasiswa->where('id', $value->id_mahasiswa) as $item)
                <td class="text-center">{{ $item->nim }}</td>
                <td class="text-center">{{ $item->nama }}</td>
                @endforeach
                <td class="col-2 text-center">
                    <a href="/data-peserta-kelas/edit/{{$value->id}}" class="btn btn-sm btn-outline-warning" title="Edit Data Peserta"><i class="fa fa-edit"></i></a>
                    <form action="/data-peserta-kelas/{{$value->id}}" method="POST" class="d-inline">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-sm btn-outline-danger ml-1" onclick="return confirm('apa kamu yakin ingin menghapus data tersebut?')" type="submit" title="Hapus Data Peserta"><i class = "fa fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
          </tbody>
          
      </table>
  </div>
</div>
@endsection
@section('js')
<script>
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
        var fileName = e.target.files[0].name;
        var label = document.querySelector('.custom-file-label');
        label.textContent = fileName;
    });
    </script>
@endsection