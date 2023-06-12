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
                <div class="row">
                    <div class="card card-border mb-0 h-100">
                        <form class="py-4" action="{{ route('pendataans.index') }}" method="post"
                            class="needs-validation" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="container pb-3">
                                <div class="row">
                                    <div class="mb-3 col-3">
                                        <label for="Pelanggan" class="form-label">Pelanggan</label>
                                        <select class="form-select" name="select_pelanggan" id="select_pelanggan">
                                            <option value="">--Pilih Pelanggan--</option>
                                            @foreach ($pelanggan as $plg)
                                                <option value="{{ $plg->id }}">
                                                    {{ $plg->id }} : {{ $plg->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nomor_hp" class="form-label">Nilai Meteran Bulan Lalu</label>
                                        <input type="number" class="form-control" id="nilai_meteran"
                                            placeholder="Masukan Nomor HP" value="" name="nilai_meteran" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nomor_hp" class="form-label">Nilai Meteran Bulan Ini</label>
                                        <input type="number" class="form-control" id="nilai_meteran"
                                            placeholder="Masukan Nomor HP" value="" name="nilai_meteran" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="foto" class="form-label">Foto Meteran </label>
                                        <input class="form-control" type="file" id="foto_meteran" name="foto_meteran">
                                    </div>
                                    <div class="text-end">
                                        <button type="reset" class="btn btn-outline-primary btn-animated">Reset</button>
                                        <button type="submit" class="btn btn-primary btn-animated">Simpan</button>
                                    </div>
                                </div>

                            </div>

                        </form>
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
