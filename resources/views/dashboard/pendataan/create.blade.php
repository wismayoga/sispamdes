@extends('layouts.main')
@section('title', 'Tambah Pendataan')

@push('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        span.select2.select2-container.select2-container--classic {
            width: 100% !important;
        }
    </style>
@endpush

@section('content')
    <div class="hk-pg-wrapper">
        <div class="container-xxl">


            <!-- Page Header -->
            <div class="hk-pg-header pg-header-wth-tab pt-7">
                <div class="d-flex">
                    <div class="d-flex flex-wrap justify-content-between flex-1">
                        <div class="mb-lg-0 mb-2 me-8">
                            <h1 class="pg-title">Form Tambah Pendataan</h1>
                            <p>Dashboard / Pendataan / Tambah</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Page Body -->
            <div class="hk-pg-body">

                @if (session()->has('error'))
                    <div class="alert alert-danger alert-wth-icon alert-dismissible fade show" role="alert">
                        <span class="alert-icon-wrap">
                            <i class="zmdi zmdi-bug"></i></i>
                        </span> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

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
                            <h6>Form tambah data pengguna</h6>
                        </div>
                        <div class="card-body">
                            <form class="py-2 needs-validation" action="{{ route('pendataans.store') }}" method="post"
                                enctype="multipart/form-data" novalidate>
                                @csrf
                                <div class="container pb-3">
                                    <div class="row">
                                        <div class="mb-3 col-3">
                                            <label for="Pelanggan" class="form-label">Pelanggan</label>
                                            <select class="form-select" name="id_pelanggan" id="select_pelanggan"
                                                required>
                                                <option value="">--Pilih Pelanggan--</option>
                                                @foreach ($pelanggan as $plg)
                                                    <option value="{{ $plg->id }}">
                                                        {{ $plg->id }} : {{ $plg->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                Pelanggan belum dipilih.
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nilai_meteran" class="form-label">Nilai Meteran Bulan Ini</label>
                                            <input type="number" class="form-control" id="nilai_meteran"
                                                placeholder="Masukan Nilai Meteran" value="" name="nilai_meteran"
                                                required>
                                            <div class="invalid-feedback">
                                                Nilai meteran belum dimasukan.
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="foto" class="form-label">Foto Meteran </label>
                                            <input class="form-control" type="file" id="foto" name="foto"
                                                required>
                                            <div class="invalid-feedback">
                                                Foto meteran belum dimasukan.
                                            </div>
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
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.dropdown-search').select2({
                theme: 'bootstrap'
            });
        });
    </script> --}}
    <script src="{{ asset('dist/js/new/dselect.js') }}"></script>
    <script>
        var select_box_element = document.querySelector('#select_pelanggan');

        dselect(select_box_element, {
            search: true,
        });
    </script>
@endpush

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
