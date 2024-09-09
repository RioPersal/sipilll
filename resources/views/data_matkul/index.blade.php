@extends('dashboard.master')
@section('judul','Data Mata Kuliah')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col">
                <h5 class="text-bold mt-2">List Mata Kuliah</h5>
            </div>
            <right>
                <div class="col mr-1">
                    <a href="{{url('/data-mata-kuliah/create/')}}" class="btn btn-sm btn-outline-success" title="Tambah Data Mata Kuliah"><i class="fa-regular fa-square-plus"></i></a>
                <button type="button" class="btn btn-sm btn-outline-success ml-1" data-toggle="modal" data-target="#modal-default" title="Import Data Mata Kuliah"><i class="fas fa-file-arrow-up"></i></button>

                <div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Import Data Mata Kuliah</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ url('/data-mata-kuliah/import') }}" method="POST" enctype="multipart/form-data">
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
                    <th class="text-center">Kode</th>
                    <th class="text-center">Nama Mata Kuliah</th>
                    <th class="text-center">Semester</th>
                    <th class="text-center">SKS</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($matkul as $key => $value)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{$value->kode_matkul}}</td>
                    <td class="text-center">{{$value->nama_matkul}}</td>
                    
                    <td class="text-center">{{$value->semester}}</td>
                    <td class="text-center">{{$value->sks}}</td>
                    <td class="text-center align-middle">
                        @if ($pengampu->where('id_matkul', $value->id)->count() == 0)
                            <a href="/data-mata-kuliah/{{$value->id}}/koordinator-dan-pengampu/create" class="btn btn-sm btn-outline-success" title="Tambah Koordinator dan Pengampu"><i class="fa fa-user"></i></a>
                        @else
                            <a href="/data-mata-kuliah/{{$value->id}}/koordinator-dan-pengampu/edit" class="btn btn-sm btn-outline-warning" title="Edit Koordinator dan Pengampu"><i class="fa fa-user"></i></a>
                        @endif
                        <a href="/data-mata-kuliah/edit/{{$value->id}}" class="btn btn-sm btn-outline-warning ml-1" title="Edit Matakuliah"><i class="fa fa-edit"></i></a>
                        
                        <form action="/data-mata-kuliah/{{$value->id}}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger ml-1" onclick="return confirm('apa kamu yakin ingin menghapus data tersebut?')" title="Hapus Matakuliah"><i class = "fa fa-trash"></i></button>
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