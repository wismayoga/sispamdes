@extends('layouts.main')
@section('title', 'Edit Data Pengguna')

@section('content')
    <div class="hk-pg-wrapper">
        <div class="container-xxl">


            <!-- Page Header -->
            <div class="hk-pg-header pg-header-wth-tab pt-7">
                <div class="d-flex">
                    <div class="d-flex flex-wrap justify-content-between flex-1">
                        <div class="mb-lg-0 mb-2 me-8">
                            <h1 class="pg-title">Edit Data Pengguna</h1>
                            <p>Create pages using a variety of features that leverage jampack components</p>
                        </div>
                        <div class="pg-header-action-wrap">
                            <div class="input-group w-300p">
                                <span class="input-affix-wrapper">
                                    <span class="input-prefix"><span class="feather-icon"><i
                                                data-feather="calendar"></i></span></span>
                                    <input class="form-control form-wth-icon" name="datetimes"
                                        value="Aug 18,2020 - Aug 19, 2020">
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Page Body -->
            <div class="hk-pg-body">
                <div class="row">
                    <div class="card card-border mb-0 h-100">
                        <div class="card-header card-header-action py-3">
                            <h6>Form edit data pengguna</h6>
                        </div>
                        <div class="card-body">
                            <form action="/users/{{ $user->id }}" method="post" class="needs-validation" novalidate>
                                @method('put')
                                @csrf
                                <div class="container pb-3">
                                    <div class="row">
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama</label>
                                            <input type="text" class="form-control" id="nama"
                                                placeholder="Masukan Nama {{ $user->role }}"
                                                value="{{ old('harga', $user->nama) }}" name="nama" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label for="level2" class="form-label">Pilih Role</label>
                                            <select class="form-select col-3" name="role">
                                                <option value="{{ $user->role }}" selected>{{ $user->role }}</option>
                                                @if ($user->role == 'Admin')
                                                    <option value="Petugas">Petugas</option>
                                                    <option value="Pelanggan">Pelanggan</option>
                                                @elseif($user->role == 'Petugas')
                                                    <option value="Admin">Admin</option>
                                                    <option value="Pelanggan">Pelanggan</option>
                                                @else
                                                    <option value="Admin">Admin</option>
                                                    <option value="Petugas">Petugas</option>
                                                @endif
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="text" class="form-control" id="email"
                                                placeholder="Masukan Email" value="{{ old('harga', $user->email) }}"
                                                name="email" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nomor_hp" class="form-label">Nomor HP</label>
                                            <input type="number" class="form-control" id="nomor_hp"
                                                placeholder="Masukan Nomor HP" value="{{ old('harga', $user->nomor_hp) }}"
                                                name="nomor_hp" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="alamat" class="form-label">Alamat</label>
                                            <textarea class="form-control" rows="3" placeholder="Masukan Alamat" 
                                            id="alamat" name="alamat" required>{{old('harga',$user->alamat)}}</textarea>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label for="level2" class="form-label">Pilih Role</label>
                                            <select class="form-select col-3" name="status">
                                                <option value="{{ $user->status }}" selected>{{ $user->status }}</option>
                                                @if ($user->status == 'Aktif')
                                                    <option value="Nonaktif">Nonaktif</option>
                                                @else
                                                    <option value="Aktif">Aktif</option>
                                                @endif
                                            </select>
                                        </div>
                                        <div class="text-end">
                                            <button type="reset"
                                                class="btn btn-outline-primary btn-animated">Reset</button>
                                            <button type="submit" class="btn btn-primary btn-animated">Simpan</button>
                                        </div>
                                    </div>

                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Body -->
        </div>
    </div>
@endsection
