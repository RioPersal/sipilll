@extends('dashboard.master')
@section('judul','Data CPL')
@section('css')

@endsection
@section('content')
<div class="card">
  <div class="card-header">
      <div class="row">
          <div class="col">
              <a href="{{url('/data-cpl/create/')}}" class="btn btn-outline-primary"><i class="fa-regular fa-square-plus mr-1"></i>Tambah Data</a>
          </div>
          <right>
              <div class="col mr-1">
                  <b>
                    <a href="#" class="btn btn-outline-info"><i class="fa fa-eye"></i></a> = Tampilkan
                    <b class="mx-2">|</b>
                    <a href="#" class="btn btn-outline-warning"><i class="fa fa-edit"></i></a> = Edit
                    <b class="mx-2">|</b>
                    <a href="#" class="btn btn-outline-danger"><i class="fa fa-trash"></i></a> = Hapus
                  </b>
              </div>
          </right>
      </div>
  </div>
  <div class="card-body">
      <table class="table table-bordered">
          <thead>
              <tr>
                  <th class="text-center col-1">No</th>
                  <th class="text-center">Kode</th>
                  <th class="text-center">Keterangan</th>
                  <th class="text-center">Aksi</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($cepeel as $key => $value)
            <tr>
                <td class="text-center">{{$key+1}}</td>
                <td class="text-center">CPL-{{$value->kode_cpl}}</td>
                <td class="text-center">{{$value->keterangan}}</td>
                <td class="col-2 text-center">
                    <a class="btn btn-outline-info"  data-toggle="collapse" href="#collapseExample{{$key+1}}"><i class="fa fa-eye"></i></a>
                    |
                    <a href="/data-cpl/edit/{{$value->id}}" class="btn btn-outline-warning"><i class="fa fa-edit"></i></a>
                    |
                    <form action="/data-cpl/{{$value->id}}" method="POST" class="d-inline">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-outline-danger" onclick="return confirm('apa kamu yakin ingin menghapus data tersebut?')" type="submit"><i class = "fa fa-trash"></i></button>
                    </form>
                    
                </td>
            </tr>
            
            @for ($i = 1; $i < 4; $i++)
            <tr class="collapse bg-light" id="collapseExample{{$key+1}}">
                <td class="text-center">
                    {{$key+1}}.
                    @switch($i)
                        @case(1)
                            a
                            @break
                        @case(2)
                            b
                            @break
                        @case(3)
                            c
                            @break
                    @endswitch
                </td>
                <td class="text-center" colspan="3">
                    @switch($i)
                        @case(1)
                            {{$value->subketerangan1}}
                            @break
                        @case(2)
                        @if ($value->subketerangan2 == null)
                            #
                        @else
                        {{$value->subketerangan2}}
                        @endif
                            @break
                        @case(3)
                        @if ($value->subketerangan3 == null)
                            #
                        @else
                        {{$value->subketerangan3}}
                        @endif
                            @break
                    @endswitch
                </td>
            </tr>
            @endfor
            @endforeach
          </tbody>
          
      </table>
  </div>
</div>
@endsection
