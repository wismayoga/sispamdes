@extends('layouts.main')
@section('title', 'Ubah Harga Air')

@section('content')
    <div class="hk-pg-wrapper">
        <div class="container-xxl">
            <!-- Page Header -->
            <div class="hk-pg-header pg-header-wth-tab pt-7">
                <div class="d-flex">
                    <div class="d-flex flex-wrap justify-content-between flex-1">
                        <div class="mb-lg-0 mb-2 me-8">
                            <h1 class="pg-title">Ubah Harga Air</h1>
                            <p>Dashboard / Harga Air / Ubah</p>
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
                            <h6>Form ubah harga air</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{route('harga.update',$harga->id)}}" method="post" class="needs-validation" novalidate>
                                @method('put')
                                @csrf
                                <div class="mb-3">
                                    <label for="level1" class="form-label">Level 1 (Rupiah)</label>
                                    <input type="text" class="form-control" id="level1" placeholder="Masukan Harga Air" 
                                    value="{{ old('harga', $harga->level1) }}" name="level1" required>
                                    <div class="invalid-feedback">
                                        Harga level1 belum dimasukan.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="level2" class="form-label">Level 2 (Rupiah)</label>
                                    <input type="text" class="form-control" id="level2" placeholder="Masukan Harga Air"
                                    value="{{ old('harga', $harga->level2) }}" name="level2" required>
                                    <div class="invalid-feedback">
                                        Harga level2 belum dimasukan.
                                    </div>
                                </div>
                                <div class="mb-6">
                                    <label for="level3" class="form-label">Level 3 (Rupiah)</label>
                                    <input type="text" class="form-control" id="level3" placeholder="Masukan Harga Air"
                                    value="{{ old('harga', $harga->level3) }}" name="level3" required>
                                    <div class="invalid-feedback">
                                        Harga level3 belum dimasukan.
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