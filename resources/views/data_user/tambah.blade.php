@extends('dashboard.master')
@section('judul','Tambah Data User')
@section('content')
<div class="card">
  <div class="card-body">
    <form class="form-horizontal" form action="{{url ('/data-user/create')}}" method="POST">
        @csrf
            <input type="hidden" name="id" value="#">

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <select class="form-control  @error('dosen_id') is-invalid  @enderror" name="dosen_id">
                        <optgroup class="text-sm" label="Dosen">
                            
                        </optgroup>
                        <optgroup class="text-sm" label="Mahasiswa">
                            
                        </optgroup>
                    </select>
                    @error('dosen_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">NIP</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('nip') is-invalid  @enderror" name="nip" value="{{ old('nip') }}" placeholder="NIP">
                    @error('nip')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('email') is-invalid  @enderror" name="email" value="{{ old('email') }}" placeholder="Email">
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
                
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Role</label>
                <div class="col-sm-10">
                    <select name="role_id" class="form-control @error('role_id') is-invalid  @enderror">
                        <option value="">- pilih -</option>
                        <option value="1">1</option>

                    </select>
                    @error('role_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
                    
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('password') is-invalid  @enderror" name="password" value="{{ old('password') }}" placeholder="Password">
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-outline-primary">Tambah</button>
            <a href="/data-user" class="btn btn-outline-secondary ml-1">Close</a>
        </div>
    </form>
</div>


@endsection
