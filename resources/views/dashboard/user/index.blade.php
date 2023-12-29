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
                            <p>Dashboard / Pengguna</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Page Body -->
            <div class="hk-pg-body">
                @if (session()->has('success'))
                            <div class="alert alert-success alert-wth-icon alert-dismissible fade show" role="alert">
                                <span class="alert-icon-wrap">
                                    <i class="zmdi zmdi-check-circle"></i>
                                </span> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                <div class="table-responsive mt-3">
                    <div class="row">
                        <div class="col-6 ">
                            {{-- <div class="btn-group dropdown">
                                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    Semua
                                </button>
                                <div class="dropdown-menu w-210p">
                                    <div class="dropdown-item">
                                        <button class="btn btn-soft-primary btn-wth-icon btn-block">
                                            <span class="">
                                                <span class="icon">
                                                    <i class="material-icons">manage_accounts</i>
                                                </span>
                                                <span class="btn-text">Admin</span>
                                            </span>
                                        </button>
                                        <button class="btn btn-soft-primary btn-wth-icon btn-block">
                                            <span class="">
                                                <span class="icon">
                                                    <i class="material-icons">person_add_alt</i>
                                                </span>
                                                <span class="btn-text">Petugas</span>
                                            </span>
                                        </button>
                                        <button class="btn btn-soft-primary btn-wth-icon btn-block">
                                            <span class="">
                                                <span class="icon">
                                                    <i class="material-icons">person</i>
                                                </span>
                                                <span class="btn-text">Pelanggan</span>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div> --}}
                            <select id="alternatifsFilter" class="form-select btn btn-soft-secondary text-start"
                                aria-label="Default select example" style="width: 150px">
                                <option class="btn btn-soft-light text-start" value="">Semua</option>
                                <option class="btn btn-soft-light text-start" value="Admin">Admin</option>
                                <option class="btn btn-soft-light text-start" value="Petugas">Petugas</option>
                                <option class="btn btn-soft-light text-start" value="Pelanggan">Pelanggan</option>
                            </select>
                        </div>
                        <div class="text-end pt-1 pb-3 col-6">
                            <a href="{{ route('qrcode') }}" type="button" class="btn btn-light btn-animated pull-right">
                                Cetak Semua QR <i class="fa fa-qrcode"></i>
                            </a>
                            <a href="{{ route('users.create') }}" type="button"
                                class="btn btn-primary btn-animated pull-right ms-2">
                                Tambah Pengguna <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>

                    {{-- <form action="{{ route('users.index') }}" method="GET">
                        <label for="search" class="sr-only">
                            Search
                        </label>
                        <div class="d-flex justify-content-start">
                            <a href="{{ route('users.index') }}" type="button"
                                class="btn btn-soft-secondary  pull-right me-3 mb-2">
                                Reset </a>
                            <input name="s" class="form-control mb-2" id="" type="text"
                                placeholder="Search...">
                        </div>
                    </form> --}}

                    {{-- <div class="input-affix-wrapper input-search mb-3" id="filterTable_filter.dataTables_filter">
                        <input type="text" class="form-control page-search" placeholder="Search" aria-label="Username"
                            aria-describedby="basic-addon1">
                        <span class="input-suffix"><span class="btn-input-clear"><i class="bi bi-x-circle-fill"></i></span>
                            <span class="spinner-border spinner-border-sm input-loader text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </span>
                        </span>
                    </div> --}}


                    <div class="table-responsive">
                        <table class="table table-hover table-filter mb-0 filter" id="filterTable">
                            <thead>
                                <tr>
                                    {{-- <th class="mnw-50p">#</th> --}}
                                    {{-- <th class="mnw-50p opacity-50">#</th> --}}
                                    <th class="mnw-50p">ID</th>
                                    <th class="mnw-50p">Role</th>
                                    <th class="mnw-150p">Nama</th>
                                    <th class="mnw-100p">Telepon</th>
                                    <th class="mnw-150p">Alamat</th>
                                    <th class="mnw-50p text-center">Status</th>
                                    <th class=""></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $user)
                                    <tr>
                                        {{-- <td class="text-truncate opacity-50">{{ $key + 1 }}</td> --}}
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
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center justify-content-end">
                                                <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Detail" href="users/{{ $user->id }}">
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
                                                <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                    action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                        data-bs-original-title="Hapus" type="submit">
                                                        <span class="icon">
                                                            <span class="feather-icon"><i data-feather="trash-2"></i>
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
                    <div class="mt-3">
                        {{-- {{ $users->links() }} --}}
                    </div>
                </div>

            </div>
            <!-- /Page Body -->
        </div>
    </div>
@endsection


{{-- <script>
    $(".table-search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".table-filter tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
</script> --}}

{{-- <script>
    $(".page-search").on("keyup", function() {
        var value1 = $(this).val().toLowerCase();
        $(".page-search-wrap .hk-section").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value1) > -1)
        });
    });
</script> --}}

<script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

<script>
    $("document").ready(function() {
        $("#filterTable").dataTable({
            "searching": true,
            "position": "relative",
            "left": "-100px",
            // "order": [
            //     [1, "asc"]
            // ], 
            // will it sort only for that page?
            // "paging":   false,
            // "lengthMenu": [
            //     [10, 50, 100, 150],
            //     [10, 50, 100, 150]
            // ],
            // scrollY: 400
            language: {
                searchPlaceholder: "Cari",
                search: "",
            },
            // "dom": "<'col-sm-12 col-md-4'><'col-sm-12 col-md-4'f><'col-sm-12 col-md-4'l>"
            "drawCallback": function(settings) {
                feather.replace();
            },
        });

        //Get a reference to the new datatable
        var table = $('#filterTable').DataTable();

        //Take the category filter drop down and append it to the datatables_filter div. 
        //You can use this same idea to move the filter anywhere withing the datatable that you want.

        // $("#filterTable_filter.dataTables_filter").append($("#searchBar"));
        // $("#alternatifsFilter").append($("#filterTable_filter.dataTables_filter"));

        //Get the column index for the Category column to be used in the method below ($.fn.dataTable.ext.search.push)
        //This tells datatables what column to filter on when a user selects a value from the dropdown.
        //It's important that the text used here (Category) is the same for used in the header of the column to filter
        var categoryIndex = 0;
        $("#filterTable th").each(function(i) {
            if ($($(this)).html() == "Role") {
                categoryIndex = i;
                return false;
            }
        });

        //Use the built in datatables API to filter the existing rows by the Category column
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var selectedItem = $('#alternatifsFilter').val()
                var category = data[categoryIndex];
                if (selectedItem === "" || category.includes(selectedItem)) {
                    return true;
                }
                return false;
            }
        );


        //Set the change event for the Category Filter dropdown to redraw the datatable each time
        //a user selects a new filter.
        $("#alternatifsFilter").change(function(e) {
            table.draw();
        });

        table.draw();
    });
</script>
