@extends('layouts.main')
@section('title', 'Edit Data Pengguna')

@section('content')
    <!-- modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Foto Meteran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if ($pendataan->foto_meteran == '')
                        <span>Dokumentasi foto tidak tersedia</span>
                    @else
                        <img src="{{ asset('storage/foto/pendataan/' . $pendataan->foto_meteran) }}" class="img-fluid rounded mx-auto d-block" alt="img">
                    @endif
                </div>
                <div class="modal-footer">
                    <span>{{ $pendataan->created_at }}</span>
                </div>
            </div>
        </div>
    </div>
    <!-- modal -->
    <div class="hk-pg-wrapper">
        <div class="container-xxl">
            <!-- Page Header -->
            <div class="hk-pg-header pg-header-wth-tab pt-7">
                <div class="d-flex">
                    <div class="d-flex flex-wrap justify-content-between flex-1">
                        <div class="mb-lg-0 mb-2 me-8">
                            <h1 class="pg-title">Edit Data Pendataan</h1>
                            <p>Dashboard / Riwayat Pendataan / Edit</p>
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
                            <h6>Form edit data pendataan</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{route('pendataans.update',$pendataan->id)}}" method="post" class="needs-validation"
                                enctype="multipart/form-data" novalidate>
                                @method('put')
                                @csrf
                                <div class="container pb-3">
                                    <div class="row">
                                        <div class="mb-3">
                                            <label for="pelanggan" class="form-label">Pelanggan</label>
                                            <input type="text" class="form-control" id="dummy"
                                                placeholder="Masukan Pelanggan"
                                                value="{{ old('pendataan', $pelanggan->nama) }}" name="dummy"
                                                required disabled>
                                            <input type="text" name="id_pelanggan" id="id_pelanggan" value="{{ old('pendataan', $pelanggan->id) }}" hidden>
                                        </div>
                                        <div class="mb-3">
                                            <label for="petugas" class="form-label">Petugas</label>
                                            <input type="text" class="form-control" id="id_petugas"
                                                placeholder="Masukan Petugas" value="{{ old('pendataan', $petugas->nama) }}"
                                                name="id_petugas" required disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nilai_meteran" class="form-label">Nilai Meteran (m<sup>3</sup>)</label>
                                            <input type="number" class="form-control" id="nilai_meteran"
                                                placeholder="Masukan Nilai Meteran"
                                                value="{{ old('pendataan', $pendataan->nilai_meteran) }}"
                                                name="nilai_meteran" required>
                                                <div class="invalid-feedback">
                                                    Nilai meteran belum dimasukan.
                                                </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="foto" class="form-label">Foto Meteran </label>
                                            <input class="form-control" type="file" id="foto"
                                                name="foto">
                                                <div class="invalid-feedback">
                                                    Foto meteran belum dimasukan.
                                                </div>
                                        </div>
                                        <div class="mt-2">
                                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                                data-bs-target="#exampleModalCenter">
                                                Lihat
                                            </button>
                                            <span>*Foto meteran sebelumnya</span>
                                        </div>
                                        <div class="mb-3 col-3 mt-2">
                                            <label for="level2" class="form-label">Status</label>
                                            <select class="form-select col-3 border border-primary" name="status_pembayaran"
                                                style="font-weight: bold;">
                                                <option value="{{ $pendataan->status_pembayaran }}" selected>
                                                    {{ $pendataan->status_pembayaran }}
                                                </option>
                                                @if ($pendataan->status_pembayaran == 'Tertunggak')
                                                    <option value="Lunas">Lunas</option>
                                                @else
                                                    <option value="Tertunggak">Tertunggak</option>
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
