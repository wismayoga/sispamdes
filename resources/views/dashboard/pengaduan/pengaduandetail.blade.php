@extends('layouts.main')
@section('title', 'Detail Kritik dan Saran')

@section('content')
    <!-- modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Foto Pengaduan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- @if ($pengaduan->foto_meteran == '')
                        <span>Dokumentasi foto tidak tersedia</span>
                    @else --}}
                    <img src="{{ asset('storage/foto/pengaduan/' . $pengaduan->foto_pengaduan) }}"
                        class="img-fluid rounded mx-auto d-block" alt="img">
                    {{-- @endif --}}
                </div>
                <div class="modal-footer">
                    <span>{{ $pengaduan->created_at }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="hk-pg-wrapper">
        <div class="container-xxl">
            <!-- Page Header -->
            <div class="hk-pg-header pg-header-wth-tab pt-7">
                <div class="d-flex">
                    <div class="d-flex flex-wrap justify-content-between flex-1">
                        <div class="mb-lg-0 mb-2 me-8">
                            <h1 class="pg-title">Detail Kritik & Saran</h1>
                            <p>Dashboard / Kritik dan Saran / Detail</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Page Body -->
            <div class="hk-pg-body">
                <div class="row">
                    <div class="card card-border mb-0 h-100">
                        <div class="card-body pt-5">
                            <div class="container pb-5">
                                <div class="table-responsive ">
                                    <div class="text-end pt-1 pb-1">
                                        <a href="{{ url()->previous() }}" type="button"
                                            class="btn btn-primary btn-animated pull-right">
                                            <span><span>Kembali</span><span class="icon"><i
                                                        class="fa fa-undo"></i></span></span>
                                        </a>
                                    </div>
                                    <table class="table table-hover table-filter mb-0">
                                        <tbody>
                                            <tr>
                                                <td class="mnw-100p text-truncate"><b> ID Pelanggan </td>
                                                <td class="mnw-50p text-truncate">:</td>
                                                <td class="mnw-500p text-truncate">{{ $pengaduan->id }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-truncate"><b>Nama </b></td>
                                                <td class="text-truncate">:</td>
                                                <td class="text-truncate">{{ $pengaduan->nama }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-truncate"><b>Nomor HP </b></td>
                                                <td class="text-truncate">:</td>
                                                <td class="text-truncate">{{ $pengaduan->nomor_hp }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-truncate"><b>Alamat</b></td>
                                                <td class="text-truncate">:</td>
                                                <td class="text-truncate">{{ $pengaduan->alamat }}</td>
                                            </tr>
                                            <tr>
                                                <td class="" colspan="3">
                                                    <br><b>Kritik dan Saran :</b></br>
                                                    <br>{{ $pengaduan->pengaduan }}</br>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="" colspan="3">
                                                    @if ($pengaduan->foto_pengaduan == '')
                                                        <button type="button" class="btn btn-primary"
                                                            data-bs-toggle="modal" data-bs-target="#exampleModalCenter" disabled>
                                                            Foto Pendukung
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-primary"
                                                            data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                                                            Foto Pendukung
                                                        </button>
                                                    @endif

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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
