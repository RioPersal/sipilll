@extends('dashboard.master')
@section('judul','CPMK')
@section('css')

@endsection
@section('content')
<div class="card">
  <div class="card-header">
      <div class="row">
          <div class="col">
            <h5 class="text-bold mt-2">List Data CPL</h5>
          </div>
          <right>
            <div class="col">
                <button type="button" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#modal-default" title="Import Data CPMK"><i class="fas fa-file-arrow-up"></i></button>

                <div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Import Data CPMK</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ url('/cpmk/import') }}" method="POST" enctype="multipart/form-data">
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
      <table class="table table-sm table-bordered" style="table-layout: fixed;">
          <thead>
              <tr>
                  <th class="text-center col-1">Kode</th>
                  <th class="text-center">Keterangan</th>
                  <th class="text-center col-2">Aksi</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($cepeels as $key => $value)
            <tr>
                <td class="text-center align-middle">{{$value->kode_cpl}}</td>
                <td class="ml-2 mr-2 align-middle">{{$value->keterangan}}</td>
                <td class="col-2 text-center align-middle">
                    <a href="{{url('/cpmk/create/'.$value->id)}}" class="btn btn-sm btn-outline-success" title="Tambah Data CPMK"><i class="fa fa-plus"></i></a>
                    <a class="btn btn-sm btn-outline-info ml-1"  data-toggle="collapse" href="#collapseExample{{$key+1}}" title="Tampilkan Data CPMK"><i class="fa fa-eye"></i></a>
                </td>
            </tr>
            
            @if ($indikator->where('id_cpl', $value->id)->count() == 0)
                <tr class="collapse bg-light" id="collapseExample{{$key+1}}">
                    <td class="text-center" colspan="3">CPMK belum tersedia, harap input CPMK terlebih dahulu</td>
                </tr>
            @else
                @foreach ($indikator->where('id_cpl', $value->id) as $data)
                    <tr class="collapse bg-light" id="collapseExample{{$key+1}}">
                        <td class="text-center align-middle">{{$data->indikator}}</td>
                        <td class="ml-2 mr-2 align-middle">{{$data->ket_indikator}}</td>
                        <td class="text-center">
                        <a href="/cpmk/edit/{{$value->id}}" class="btn btn-sm btn-outline-warning" title="Edit Data CPMK"><i class="fa fa-edit"></i></a>

                        <form action="/cpmk/{{$data->id}}" method="POST" class="d-inline">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-sm ml-1 btn-outline-danger" onclick="return confirm('apa kamu yakin ingin menghapus data tersebut?')" type="submit" title="Hapus Data CPMK"><i class ="fa fa-trash"></i></button>
                        </form>
                        </td>
                    </tr>
                @endforeach
            @endif
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