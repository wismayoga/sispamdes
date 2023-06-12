@extends('layouts.main')
@section('title', 'Detail Kritik dan Saran')

@section('content')
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
                                                    <br>{{$pengaduan->pengaduan}}</br>
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
