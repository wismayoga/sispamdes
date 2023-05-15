@extends('layouts.main')
@section('title', 'Harga Air')

@section('content')
    <div class="hk-pg-wrapper">
        <div class="container-xxl">
            

            <!-- Page Header -->
            <div class="hk-pg-header pg-header-wth-tab pt-7">
                <div class="d-flex">
                    <div class="d-flex flex-wrap justify-content-between flex-1">
                        <div class="mb-lg-0 mb-2 me-8">
                            <h1 class="pg-title">Harga Air</h1>
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

                <div class="table-responsive">
                    <table class="table nowrap table-advance">
                        <thead>
                            <tr>
                                <th class="mnw-200p"></th>
                                <th class="mnw-200p">Level 1</th>
                                <th class="mnw-200p">Level 2</th>
                                <th class="mnw-200p">Level 3</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($harga as $harga)
                                <tr>
                                    <td class="text-truncate"> Harga </td>
                                    <td class="text-truncate">Rp.{{ number_format($harga->level1, 0, ',', '.') }},-</span>
                                    </td>
                                    <td class="text-truncate">Rp.{{ number_format($harga->level2, 0, ',', '.') }},-</span>
                                    </td>
                                    <td class="text-truncate">Rp.{{ number_format($harga->level3, 0, ',', '.') }},-</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-end">
                                            {{-- <a href="/dashboard/alternatifs/{{ $harga->id }}/edit?page={{ app('request')->input('page') }}"
                                                class="btn btn-sm btn-success sm-4 mb-1" type="button">
                                                <span class="fas fa-edit"></span>
                                            </a> --}}
                                            <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                data-bs-original-title="Edit" type="button"
                                                href="harga/{{ $harga->id }}/edit">
                                                <span class="icon">
                                                    <span class="feather-icon"><i data-feather="edit-2"></i>
                                                    </span>
                                                </span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="table-row-gap">
                                    <td></td>
                                </tr>
                            @endforeach ($harga as $harga)
                        </tbody>
                    </table>
                </div>

            </div>
            <!-- /Page Body -->
        </div>
    </div>
@endsection
