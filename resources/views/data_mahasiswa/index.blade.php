@extends('dashboard.master')
@section('judul','Data Mahasiswa')
@section('content')
<div class="card">
  <div class="card-header">
      <div class="row">
            <div class="col">
                <h5 class="text-bold mt-2">List Mahasiswa</h5>
            </div>
          <right>
              <div class="col mr-1">
                <a href="{{url('/data-mahasiswa/create/')}}" class="btn btn-sm btn-outline-success" title="Tambah Data Mahasiswa"><i class="fa-regular fa-square-plus"></i></a>
                <button type="button" class="btn btn-sm btn-outline-success ml-1" data-toggle="modal" data-target="#modal-default" title="Import Data Mahasiswa"><i class="fas fa-file-arrow-up"></i></button>
                

                <div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Import Data Mahasiswa</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ url('/data-mahasiswa/import') }}" method="POST" enctype="multipart/form-data">
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
      <table class="table table-sm table-bordered">
          <thead>
              <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">NIM</th>
                  <th class="text-center">Nama</th>
                  <th class="text-center">Angkatan</th>
                  <th class="text-center col-2">Aksi</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($mahasiswa as $key => $value)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class="text-center">{{$value->nim}}</td>
                <td class="text-center">{{$value->nama}}</td>
                <td class="text-center">{{$value->angkatan}}</td>
                <td class="col-2 text-center">
                  <a href="/data-mahasiswa/edit/{{$value->id}}" class="btn btn-sm btn-outline-warning" title="Edit Data Mahasiswa"><i class="fa fa-edit"></i></a>
                  {{-- | --}}
                  <form action="/data-mahasiswa/{{$value->id}}" method="POST" class="d-inline">
                      @method('DELETE')
                      @csrf
                      <button class="btn btn-sm ml-1 btn-outline-danger" onclick="return confirm('apa kamu yakin ingin menghapus data tersebut?')" type="submit" title="Hapus Data Mahasiswa"><i class = "fa fa-trash"></i></button>
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