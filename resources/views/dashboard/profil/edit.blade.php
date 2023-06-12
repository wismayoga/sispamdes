@extends('layouts.main')
@section('title', 'Ubah Profil')

@section('content')
    <div class="hk-pg-wrapper">
        <div class="container-xxl">
            <!-- Page Header -->
            <div class="hk-pg-header pg-header-wth-tab pt-7">
                <div class="d-flex">
                    <div class="d-flex flex-wrap justify-content-between flex-1">
                        <div class="mb-lg-0 mb-2 me-8">
                            <h1 class="pg-title">Ubah Profil</h1>
                            <p>Dashboard / Profil / Ubah</p>
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
                        <div class="card-header card-header-action py-3">
                            <h6>Form Ubah Profil</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('profile.update', $user->id) }}" method="post" class="needs-validation"
                                enctype="multipart/form-data" novalidate>
                                @method('put')
                                @csrf
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" placeholder="Masukan Nama"
                                        value="{{ old('nama', $user->nama) }}" name="nama" required>
                                    <div class="invalid-feedback">
                                        Nama belum dimasukan.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="Masukan Email"
                                        value="{{ old('email', $user->email) }}" name="email" required>
                                    <div class="invalid-feedback">
                                        Email belum dimasukan.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="nomor_hp" class="form-label">Nomor HP</label>
                                    <input type="number" class="form-control" id="nomor_hp" placeholder="Masukan Nomor HP"
                                        value="{{ old('nomor_hp', $user->nomor_hp) }}" name="nomor_hp" required>
                                    <div class="invalid-feedback">
                                        Nomor HP belum dimasukan.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="foto" class="form-label">Foto Profil </label>
                                    <input class="form-control" type="file" id="foto" name="foto">
                                    <div class="invalid-feedback">
                                        Foto profil belum dimasukan.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea rows="3" class="form-control" id="alamat" placeholder="Masukan Alamat" name="alamat" required>{{ old('alamat', $user->alamat) }}</textarea>
                                    <div class="invalid-feedback">
                                        Alamat belum dimasukan.
                                    </div>
                                </div>


                                <button type="reset" class="btn btn-outline-primary btn-animated">Reset</button>
                                <button type="submit" class="btn btn-primary btn-animated">Simpan</button>
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
