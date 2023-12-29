@extends('layouts.main')
@section('title', 'Detail Pendataan')

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
                    @if($pendataan->foto_meteran == '')
                    <span>Dokumentasi foto tidak tersedia</span>
                    @else
                    <img src="{{ asset('storage/foto/pendataan/' . $pendataan->foto_meteran) }}" class="img-fluid rounded mx-auto d-block" alt="img" height="100">
                    @endif
                </div>
                <div class="modal-footer">
                    <span>
                        {{ \Carbon\Carbon::parse($pendataan->created_at)->translatedFormat('l, d M Y', 'id') }}
                    </span>
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
                            <h1 class="pg-title">Detail Pendataan</h1>
                            <p>Dashboard / Pendataaan / Detail</p>
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
                                                <td class="mnw-100p text-truncate"><b> Id Pelanggan </td>
                                                <td class="mnw-50p text-truncate">:</td>
                                                <td class="mnw-500p text-truncate">{{ $pendataan->id }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-truncate"><b>Nama Pelanggan </b></td>
                                                <td class="text-truncate">:</td>
                                                <td class="text-truncate">{{ $pendataan->nama_pelanggan }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-truncate"><b>Tanggal </b></td>
                                                <td class="text-truncate">:</td>
                                                <td class="text-truncate">{{ \Carbon\Carbon::parse($pendataan->created_at)->translatedFormat('l, d M Y', 'id') }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-truncate"><b>Nama Petugas </b></td>
                                                <td class="text-truncate">:</td>
                                                <td class="text-truncate">{{ $pendataan->nama_petugas }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-truncate"><b>Nilai Meteran </b></td>
                                                <td class="text-truncate">:</td>
                                                <td class="text-truncate">{{ $pendataan->nilai_meteran }} (m<sup>3</sup>)</td>
                                            </tr>
                                            <tr>
                                                <td class="text-truncate"><b>Foto Meteran </b></td>
                                                <td class="text-truncate">:</td>
                                                <td class="text-truncate">
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModalCenter">
                                                        Lihat
                                                    </button>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-truncate"><b>Total Harga</b></td>
                                                <td class="text-truncate">:</td>
                                                <td class="text-truncate">Rp.{{ number_format($pendataan->total_harga, 0, ',', '.') }},-</td>
                                            </tr>
                                            <tr>
                                                <td class="text-truncate"><b>Status</b></td>
                                                <td class="text-truncate">:</td>
                                                <td class="text-truncate">
                                                    <b>{{ $pendataan->status_pembayaran }}</b>
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
