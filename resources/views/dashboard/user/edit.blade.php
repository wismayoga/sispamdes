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
                            <p>Dashboard / Pengguna / Edit</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Page Body -->
            <div class="hk-pg-body">
                <div class="row mb-3">
                    <div class="text-end pt-1 col-12">
                        <a href="{{ url()->previous() }}" type="button" class="btn btn-primary btn-animated pull-right">
                            <span><span>Kembali</span><span class="icon"><i class="fa fa-undo"></i></span></span>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="card card-border mb-0 h-100">
                        <div class="card-body">
                            <form action="{{route('users.update',$user->id)}}" method="post" class="needs-validation" novalidate>
                                @method('put')
                                @csrf
                                <div class="container pb-3">
                                    <div class="row">
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama</label>
                                            <input type="text" class="form-control" id="nama"
                                                placeholder="Masukan nama" value="{{ old('user', $user->nama) }}"
                                                name="nama" required>
                                            <div class="invalid-feedback">
                                                Nama belum dimasukan.
                                            </div>
                                        </div>
                                        <div class="mb-3 col-2">
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
                                            <div class="invalid-feedback">
                                                Role belum dimasukan.
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email"
                                                placeholder="Masukan email" value="{{ old('user', $user->email) }}"
                                                name="email" required>
                                            <div class="invalid-feedback">
                                                Email belum dimasukan.
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nomor_hp" class="form-label">Nomor HP</label>
                                            <input type="number" class="form-control" id="nomor_hp"
                                                placeholder="Masukan nomor hp" value="{{ old('user', $user->nomor_hp) }}"
                                                name="nomor_hp" required>
                                            <div class="invalid-feedback">
                                                Nomor HP belum dimasukan.
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="alamat" class="form-label">Alamat</label>
                                            <textarea class="form-control" rows="3" placeholder="Masukan alamat" id="alamat" name="alamat" required>{{ old('user', $user->alamat) }}</textarea>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label for="level2" class="form-label">Status</label>
                                            <select class="form-select col-3" name="status">
                                                <option value="{{ $user->status }}" selected>{{ $user->status }}</option>
                                                @if ($user->status == 'Aktif')
                                                    <option value="Nonaktif">Nonaktif</option>
                                                @else
                                                    <option value="Aktif">Aktif</option>
                                                @endif
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password Baru</label>
                                            <input autocomplete="new-password" type="password" class="form-control"
                                                id="password" placeholder="Masukan password baru" value=""
                                                name="password">
                                            <small id="passwordHelpBlock" class="form-text text-muted">
                                                *Tambahkan password jika ingin mengubah password
                                            </small>
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

@push('script')
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (() => {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
@endpush
