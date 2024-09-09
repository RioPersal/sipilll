@extends('dashboard.master')
@section('judul','Data Admin')
@section('content')
<div class="card">
  <div class="card-header">
      <div class="row">
          <div class="col">
            <h5 class="text-bold mt-2">List Admin</h5>
            </div>
          <right>
              <div class="col mr-1">
                <a href="{{url('/data-admin/create/')}}" class="btn btn-sm btn-outline-success" title="Tambah Data Admin"><i class="fa-regular fa-square-plus"></i></a>
              </div>
          </right>
      </div>
  </div>
  <div class="card-body">
      <table class="table table-sm table-bordered">
          <thead>
              <tr>
                  <th class="text-center col-1">No</th>
                  <th class="text-center">Nama</th>
                  <th class="text-center col-2">Aksi</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($admin as $key => $value)
            <tr>
                <td class="text-center align-middle">{{ $loop->iteration }}</td>
                <td class="text-center align-middle">
                    @if (isset($value->gelar_depan))
                    {{$value->gelar_depan}}.    
                    @endif

                    {{$value->nama}}

                    @if (isset($value->gelar_belakang))
                    {{$value->gelar_belakang}}
                    @endif
                  </td>
                <td class="col-2 text-center">
                  <a href="/data-admin/edit/{{$value->id}}" class="btn btn-sm btn-outline-warning" title="Edit Data Admin"><i class="fa fa-edit"></i></a>
                  {{-- | --}}
                  <form action="/data-admin/{{$value->id}}" method="POST" class="d-inline">
                      @method('DELETE')
                      @csrf
                      <button class="btn btn-sm btn-outline-danger ml-1" onclick="return confirm('apa kamu yakin ingin menghapus data tersebut?')" type="submit" title="Hapus Data Admin"><i class = "fa fa-trash"></i></button>
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