@extends('layouts.main')
@section('title', 'Detail Pengguna')

@section('content')
    <div class="hk-pg-wrapper">
        <div class="container-xxl">


            <!-- Page Header -->
            <div class="hk-pg-header pg-header-wth-tab pt-7">
                <div class="d-flex">
                    <div class="d-flex flex-wrap justify-content-between flex-1">
                        <div class="mb-lg-0 mb-2 me-8">
                            <h1 class="pg-title">Detail Pengguna</h1>
                            <p>Dashboard / Pengguna / Detail</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Page Body -->
            <div class="hk-pg-body">
                <div class="row">
                    <div class="row mb-3">
                        <div class="text-end pt-1 col-12">
                            <form class="form-inline" action="{{ url('/qrcode', [$user->id]) }}" method="GET">
                                @csrf
                                <button class="btn btn-light btn-animated pull-right me-2" type="submit">
                                    Cetak QR <i class="fa fa-qrcode"></i>
                                </button>
                                <a href="{{ route('pendataans.create', ['pengaduan' => $user->id]) }}" type="button"
                                    class="btn btn-primary btn-animated pull-right me-2">
                                    <span><span>Tambah Pendataan</span><span class="icon"><i
                                                class="fa fa-plus"></i></span></span>
                                </a>
                                <a href="{{ url()->previous() }}" type="button"
                                    class="btn btn-secondary btn-animated pull-right">
                                    <span><span>Kembali</span><span class="icon"><i class="fa fa-undo"></i></span></span>
                                </a>
                            </form>
                           
                        </div>
                    </div>
                    <div class="card card-border mb-5 h-100">
                        <div class="card-header">
                            <b>Detail Pengguna</b>
                        </div>
                        <div class="card-body pt-5">
                            <div class="container pb-5">
                                <div class="table-responsive ">
                                    <table class="table table-hover table-filter mb-0">
                                        <tbody>
                                            <tr>
                                                <td class="mnw-150p text-truncate"><b>ID Pengguna </td>
                                                <td class="mnw-50p text-truncate">:</td>
                                                <td class="mnw-500p text-truncate">{{ $user->id }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-truncate"><b>Nama </b></td>
                                                <td class="text-truncate">:</td>
                                                <td class="text-truncate">{{ $user->nama }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-truncate"><b>Role </b></td>
                                                <td class="text-truncate">:</td>
                                                <td class="text-truncate">{{ $user->role }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-truncate"><b>Email </b></td>
                                                <td class="text-truncate">:</td>
                                                <td class="text-truncate">{{ $user->email }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-truncate"><b>Nomor HP </b></td>
                                                <td class="text-truncate">:</td>
                                                <td class="text-truncate">{{ $user->nomor_hp }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-truncate"><b>Alamat</b></td>
                                                <td class="text-truncate">:</td>
                                                <td class="text-truncate">{{ $user->alamat }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-truncate"><b>Status</b></td>
                                                <td class="text-truncate">:</td>
                                                <td class="text-truncate">{{ $user->status }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-truncate"><b>Pendataan Bulan ini</b></td>
                                                <td class="text-truncate">:</td>
                                                <td class="text-truncate">
                                                    @if ($status == 'Sudah')
                                                        <span class="badge badge-primary">
                                                            {{ $status }}
                                                        </span>
                                                    @else
                                                        <span class="badge badge-secondary">
                                                            {{ $status }}
                                                        </span>
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
                    <div class="card card-border mb-0 h-100">
                        <div class="card-header">
                            <b>Riwayat Pendataan</b>
                        </div>
                        <div class="card-body pt-5">
                            <div class="container pb-5">
                                <div class="table-responsive ">
                                    <table class="table table-hover table-filter mb-0">
                                        <thead>
                                            <tr>
                                                <th class="mnw-50p opacity-50">#</th>
                                                <th class="mnw-150p">Pelanggan</th>
                                                <th class="mnw-50p">Nilai Meteran(m<sup>3</sup>)</th>
                                                <th class="mnw-50p">Penggunaan(m<sup>3</sup>)</th>
                                                <th class="mnw-50p">Total Harga</th>
                                                <th class="mnw-100p text-center">Tanggal</th>
                                                <th class="mnw-50p text-center">Status</th>
                                                <th class=" text-center"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pendataan as $key => $data)
                                                <tr>
                                                    <td class="text-truncate opacity-50">
                                                        {{ $pendataan->firstItem() + $key }}</td>
                                                    <td class="text-truncate">{{ $data->nama_pelanggan }}</span></td>
                                                    <td class="text-truncate">{{ $data->nilai_meteran }}</td>
                                                    <td class="text-truncate">{{ $data->total_penggunaan }}</td>
                                                    <td class="text-truncate">Rp.
                                                        {{ number_format($data->total_harga, 0, ',', '.') }},-</span></td>
                                                    {{-- <td class="text-truncate">{{ $data->created_at }}</td> --}}
                                                    <td class="text-truncate">
                                                        {{ date('d-m-Y', strtotime($data->created_at)) }}</td>
                                                    <td class="text-truncate text-center">
                                                        @if ($data->status_pembayaran == 'Lunas')
                                                            <span class="badge badge-primary badge-pill">
                                                                {{ $data->status_pembayaran }}
                                                            </span>
                                                        @else
                                                            <span class="badge badge-secondary badge-pill">
                                                                {{ $data->status_pembayaran }}
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center justify-content-end">
                                                            <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="" data-bs-original-title="Detail"
                                                                href="{{ url('/pendataans', $data->id) }}">
                                                                <span class="icon">
                                                                    <span class="feather-icon"><i data-feather="eye"></i>
                                                                    </span>
                                                                </span>
                                                            </a>
                                                            <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="" data-bs-original-title="Edit"
                                                                type="button"
                                                                href="pendataans/{{ $data->id }}/edit">
                                                                <span class="icon">
                                                                    <span class="feather-icon"><i
                                                                            data-feather="edit-2"></i>
                                                                    </span>
                                                                </span>
                                                            </a>
                                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                                action="{{ url('/pendataans', $data->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button
                                                                    class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="" data-bs-original-title="Hapus"
                                                                    type="submit">
                                                                    <span class="icon">
                                                                        <span class="feather-icon"><i
                                                                                data-feather="trash-2"></i>
                                                                        </span>
                                                                    </span>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach ($harga as $harga)
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            </form>
                        </div>
                        {{ $pendataan->links() }}
                    </div>
                </div>
            </div>
            <!-- /Page Body -->
        </div>
    </div>
@endsection
