@extends('layouts.main')
@section('title', 'Management Pengguna')

@section('content')
    <div class="hk-pg-wrapper">
        <div class="container-xxl">


            <!-- Page Header -->
            <div class="hk-pg-header pg-header-wth-tab pt-7">
                <div class="d-flex">
                    <div class="d-flex flex-wrap justify-content-between flex-1">
                        <div class="mb-lg-0 mb-2 me-8">
                            <h1 class="pg-title">Management Pengguna</h1>
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

                <div class="table-responsive mt-3">
                    <div class="text-end pt-1 pb-3">
                        <button type="button" class="btn btn-primary btn-animated pull-right">
                            Tambah Pengguna
                        </button>
                    </div>
                    <input class="form-control mb-2 table-search" id="" type="text" placeholder="Search...">
                    <div class="table-responsive ">
                        <table class="table table-hover table-filter mb-0">
                            <thead>
                                <tr>
                                    {{-- <th class="mnw-50p">#</th> --}}
                                    <th class="mnw-50p">#</th>
                                    <th class="mnw-50p">ID</th>
                                    <th class="mnw-50p">Role</th>
                                    <th class="mnw-50p">Nama</th>
                                    <th class="mnw-50p">Telepon</th>
                                    <th class="mnw-50p">Alamat</th>
                                    <th class="mnw-50p text-center">Status</th>
                                    <th class="">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $user)
                                    <tr>
                                        <td class="text-truncate">{{ $key + $users->firstItem() }}</td>
                                        <td class="text-truncate">{{ $user->id }}</span></td>
                                        <td class="text-truncate">{{ $user->role }}</span></td>
                                        <td class="text-truncate">{{ $user->nama }}</span></td>
                                        <td class="text-truncate">{{ $user->nomor_hp }}</span></td>
                                        <td class="text-truncate">{{ $user->alamat }}</span></td>
                                        <td class="text-truncate text-center">
                                            @if ($user->status == 'Aktif')
                                                <span class="badge badge-primary badge-pill">
                                                    {{ $user->status }}
                                                </span>
                                            @else
                                                <span class="badge badge-secondary badge-pill">
                                                    {{ $user->status }}
                                                </span>
                                            @endif
                                        <td>
                                            <div class="d-flex align-items-center justify-content-end">
                                                <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Detail" href="#">
                                                    <span class="icon">
                                                        <span class="feather-icon"><i data-feather="eye"></i>
                                                        </span>
                                                    </span>
                                                </a>
                                                <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Edit" type="button"
                                                    href="users/{{ $user->id }}/edit">
                                                    <span class="icon">
                                                        <span class="feather-icon"><i data-feather="edit-2"></i>
                                                        </span>
                                                    </span>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach ($harga as $harga)
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-2">
                        {{ $users->links() }}
                    </div>
                </div>

            </div>
            <!-- /Page Body -->
        </div>
    </div>
@endsection
