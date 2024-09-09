@extends('dashboard.master')
@section('judul','Edit Data Dosen')
@section('content')
<div class="card">
  <div class="card-body">
    <form class="form-horizontal" form action="/data-dosen/edit/{{$dosen->id}}" method="POST">
        @csrf
            <input type="hidden" name="id" value="{{ old('id', $dosen->id) }}">

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('nama') is-invalid  @enderror" name="nama" value="{{ old('nama', $dosen->nama) }}" placeholder="Nama">
                    @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">NIP</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('nip') is-invalid  @enderror" name="nip" value="{{ old('nip', $dosen->nip) }}" placeholder="NIP">
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
                    <input type="text" class="form-control @error('email') is-invalid  @enderror" name="email" value="{{ old('email', $dosen->email) }}" placeholder="Email">
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
                        <option value="{{$dosen->role_id}}" {{old('role_id', $dosen->role_id) == $dosen->id ? 'selected' : null}}>{{$dosen->role_id}}</option>
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
                    <input type="text" class="form-control @error('password') is-invalid  @enderror" name="password" value="{{ old('password', $dosen->password) }}" placeholder="Password">
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary">Edit</button>
            <a href="/data-dosen" class="btn btn-outline-secondary ml-1">Close</a>
        </div>
    </form>
</div>


@endsection
