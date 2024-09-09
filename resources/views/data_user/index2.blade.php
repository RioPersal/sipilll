@extends('dashboard.master')
@section('judul','Data User')
@section('content')
<div class="card">
  <div class="card-header">
      <div class="row">
          <div class="col">
              <a href="{{url('/data-user/create/')}}" class="btn btn-outline-primary"><i class="fa-regular fa-square-plus mr-1"></i>Tambah Data</a>
          </div>
          <right>
              <div class="col mr-1">
                  <b>
                    <a href="#" class="btn btn-outline-warning"><i class="fa fa-edit"></i></a> = Edit
                    <b class="mx-2">|</b>
                    <a href="#" class="btn btn-outline-danger"><i class="fa fa-trash"></i></a> = Hapus
                  </b>
              </div>
          </right>
      </div>
  </div>
  <div class="card-body">
      <table class="table table-bordered table-striped">
          <thead>
              <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">NIM</th>
                  <th class="text-center">Nama</th>
                  <th class="text-center">Email</th>
                  <th class="text-center">Angkatan</th>
                  <th class="text-center">Role</th>
                  <th class="text-center">Aksi</th>
              </tr>
          </thead>
          <tbody>
            
          </tbody>

      </table>
  </div>
</div>
@endsection
