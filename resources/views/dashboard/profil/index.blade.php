@extends('layouts.main')
@section('title', 'Profil')

@section('content')
    <div class="hk-wrapper" data-layout="vertical" data-layout-style="default" data-menu="light" data-footer="simple">
        <!-- Main Content -->
        <div class="hk-pg-wrapper">

            <!-- Page Body -->
            <div class="hk-pg-body">
                <div class="container-xxl">
                    <div class="profile-wrap">
                        <div class="profile-img-wrap">
                            <img class="img-fluid rounded-5" src="https://source.unsplash.com/featured/1920x400" alt="Image Description">
                        </div>

                        <div class="profile-intro">
                            <div class="card card-flush mw-400p bg-transparent">
                                <div class="card-body">
                                    <div class="avatar avatar-xxl avatar-rounded position-relative mb-2">
                                        @if ($user->foto_profil == null)
                                            <img src="{{ url('assets/img') }}/user.png" alt="user"
                                                class="avatar-img border border-4 border-white bg-white" />
                                        @else
                                            <img src="{{ asset('storage/foto/profil/' . $user->foto_profil) }}"
                                                alt="user" class="avatar-img border border-4 border-white bg-white" />
                                        @endif

                                        <span
                                            class="badge badge-indicator badge-success  badge-indicator-xl position-bottom-end-overflow-1 me-1"></span>
                                    </div>
                                    <h4>
                                        {{ $user->nama }}
                                    </h4>

                                </div>
                            </div>
                        </div>
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-wth-icon alert-dismissible fade show" role="alert">
                                <span class="alert-icon-wrap">
                                    <i class="zmdi zmdi-check-circle"></i>
                                </span> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="card card-border mb-5 h-100">
                            <div class="card-header">
                                <b>Profil</b>
                                <div>
                                    <a href="{{ route('change-password', $user->id) }}" type="button"
                                        class="btn btn-light btn-animated pull-right">
                                        Ubah Password <i class="fa fa-key"></i>
                                    </a>
                                    <a href="{{ route('profile.edit', $user->id) }}" type="button"
                                        class="btn btn-light btn-animated pull-right">
                                        Ubah Profil <i class="fa fa-edit"></i>
                                    </a>

                                </div>
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
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Body -->

            <!-- Page Footer -->
            <div class="hk-footer">
                <footer class="container-xxl footer">
                    <div class="row">
                        <div class="col-xl-8">
                            <p class="footer-text"><span class="copy-text">Jampack © 2022 All rights reserved.</span> <a
                                    href="#" class="" target="_blank">Privacy Policy</a><span
                                    class="footer-link-sep">|</span><a href="#" class=""
                                    target="_blank">T&C</a><span class="footer-link-sep">|</span><a href="#"
                                    class="" target="_blank">System Status</a></p>
                        </div>
                        <div class="col-xl-4">
                            <a href="#" class="footer-extr-link link-default"><span class="feather-icon"><i
                                        data-feather="external-link"></i></span><u>Send feedback to our help forum</u></a>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- / Page Footer -->

        </div>
        <!-- /Main Content -->
    </div>
@endsection
