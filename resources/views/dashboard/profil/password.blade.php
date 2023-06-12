@extends('layouts.main')
@section('title', 'Ubah Password')

@section('content')
    <div class="hk-pg-wrapper">
        <div class="container-xxl">
            <!-- Page Header -->
            <div class="hk-pg-header pg-header-wth-tab pt-7">
                <div class="d-flex">
                    <div class="d-flex flex-wrap justify-content-between flex-1">
                        <div class="mb-lg-0 mb-2 me-8">
                            <h1 class="pg-title">Ubah Password</h1>
                            <p>Dashboard / Profil / Ubah Password</p>
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
                    @if (session()->has('error'))
                            <div class="alert alert-danger alert-wth-icon alert-dismissible fade show" role="alert">
                                <span class="alert-icon-wrap">
                                    <i class="zmdi zmdi-bug"></i>
                                </span> {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                    <div class="card card-border mb-0 h-100">
                        <div class="card-body">
                            <form action="{{ route('update-password', $user->id) }}" method="post" class="needs-validation"
                                novalidate>
                                {{-- @method('put') --}}
                                @csrf
                                <div class="mb-3">
                                    <label for="old_password" class="form-label">Password Lama</label>
                                    <input autocomplete="new-password" type="password" class="form-control"
                                        id="old_password" placeholder="Masukan password lama" value=""
                                        name="old_password" required>
                                    <div class="invalid-feedback">
                                        Password lama belum dimasukan.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="new_password" class="form-label">Password Baru</label>
                                    <input autocomplete="new-password" type="password" class="form-control"
                                        id="new_password" placeholder="Masukan password baru" value=""
                                        name="new_password" required>
                                    <div class="invalid-feedback">
                                        Password baru belum dimasukan.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="new_password_confirmation" class="form-label">Ulang Password Baru</label>
                                    <input autocomplete="new-password" type="password" class="form-control"
                                        id="new_password_confirmation" placeholder="Masukan ulang password baru" value=""
                                        name="new_password_confirmation" required>
                                    <div class="invalid-feedback">
                                        Ulang Password baru belum dimasukan.
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
