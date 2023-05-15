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
                            <h6>Harga Air</h6>
                        </div>
                        <div class="card-body">
                            <form action="/harga/{{$harga->id}}" method="post" class="needs-validation" novalidate>
                                @method('put')
                                @csrf
                                <div class="mb-3">
                                    <label for="level1" class="form-label">Level 1 (Rupiah)</label>
                                    <input type="text" class="form-control" id="level1" placeholder="Masukan Harga Air" 
                                    value="{{ old('harga', $harga->level1) }}" name="level1" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="level2" class="form-label">Level 2 (Rupiah)</label>
                                    <input type="text" class="form-control" id="level2" placeholder="Masukan Harga Air"
                                    value="{{ old('harga', $harga->level2) }}" name="level2" required>
                                </div>
                                <div class="mb-6">
                                    <label for="level3" class="form-label">Level 3 (Rupiah)</label>
                                    <input type="text" class="form-control" id="level3" placeholder="Masukan Harga Air"
                                    value="{{ old('harga', $harga->level3) }}" name="level3" required>
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
