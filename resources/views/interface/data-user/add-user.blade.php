@extends('layouts.app')

@section('content')
<div class="section-header">
  <h1>Tambah Data Pengguna</h1>
</div>

<div class="section-body">
  <div class="card">
    <form method="POST" action="{{ route('data-user.store') }}">
      @csrf
      <div class="card-body">
        <div class="form-group">
          <label>Nama User</label>
          <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
            value="{{ old('name') }}" required autocomplete="name" autofocus>
          @error('name')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="form-group">
          <label>Username</label>
          <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username"
            value="{{ old('username') }}" required autocomplete="username" autofocus>
          @error('username')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="form-group">
          <label>Jabatan</label>
          <select name="jabatan" id="jabatan" class="custom-select">
            <option value="none" disabled selected>- Pilih Jabatan -</option>
            <option value="owner">Owner</option>
            <option value="Admin">Staff Admin</option>
          </select>
        </div>

        <div class="form-group">
          <label>Password</label>
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
            name="password" required autocomplete="new-password">

          @error('password')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <div class="card-footer text-right">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('data-user.index') }}" type="button" class="btn btn-danger">Batal</a>
      </div>
    </form>
  </div>
</div>
@endsection