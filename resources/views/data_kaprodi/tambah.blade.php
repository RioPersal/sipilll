@extends('dashboard.master')
@section('judul','Tambah Data Admin')
@section('content')
<div class="card">
  <div class="card-body">
    <form class="form-horizontal" form action="{{url ('/data-admin/create')}}" method="POST">
        @csrf
            <input type="hidden" name="id" value="#">

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
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-outline-primary">Tambah</button>
            <a href="/data-admin" class="btn btn-outline-secondary ml-1">Close</a>
        </div>
    </form>
</div>


@endsection
