@extends('layouts.main')
@section('title', 'Riwayat Pendataan')

@section('content')

    <div class="hk-pg-wrapper">
        <div class="container-xxl">


            <!-- Page Header -->
            <div class="hk-pg-header pg-header-wth-tab pt-7">
                <div class="d-flex">
                    <div class="d-flex flex-wrap justify-content-between flex-1">
                        <div class="mb-lg-0 mb-2 me-8">
                            <h1 class="pg-title">Riwayat Pendataan</h1>
                            <p>Dashboard / Riwayat Pendataan</p>
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
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row">
                    <div class="col-6">
                        <select id="alternatifsFilter" class="form-select btn btn-soft-secondary text-start opacity-0"
                            aria-label="Default select example" style="width: 150px; position: absolute; left: -9999px;">
                            <option class="btn btn-soft-light text-start" value="">Semua</option>
                        </select>
                    </div>
                    <div class="text-end col-6">
                        <a href="{{ route('pendataans.create') }}" type="button"
                            class="btn btn-primary btn-animated pull-right">
                            Tambah Data <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="table-responsive mt-3">
                    <div class="table-responsive">
                        <table class="table table-hover table-filter mb-0 filter" id="filterTable">
                            <thead>
                                <tr>
                                    {{-- <th class="mnw-50p">#</th> --}}
                                    <th class="mnw-50p opacity-50">#</th>
                                    {{-- <th class="mnw-50p">Petugas</th> --}}
                                    <th class="mnw-150p">Pelanggan</th>
                                    <th class="mnw-100p">Nilai Meteran(m<sup>3</sup>)</th>
                                    <th class="mnw-50p">Penggunaan(m<sup>3</sup>)</th>
                                    <th class="mnw-150p">Total Harga</th>
                                    <th class="mnw-50p text-center">Status</th>
                                    <th class=""></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pendataan as $key => $data)
                                    <tr>
                                        <td class="text-truncate opacity-50">{{ $key + 1 }}</td>
                                        {{-- <td class="text-truncate text-lg">{{ $data->nama_petugas }}</span></td> --}}
                                        <td class="text-truncate">{{ $data->nama_pelanggan }}</span></td>
                                        <td class="text-truncate">{{ $data->nilai_meteran }}</td>
                                        <td class="text-truncate">{{ $data->total_penggunaan }}</td>
                                        <td class="text-truncate">Rp.
                                            {{ number_format($data->total_harga, 0, ',', '.') }},-</span></td>
                                        <td class="text-truncate text-center">
                                            <form onsubmit="return confirm('Ingin mengubah status ?');"
                                                action="{{ url('/pendataans/status', [$data->id]) }}" method="post">
                                                @method('put')
                                                @csrf
                                                <button class="badge badge-primary badge-pill" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="" data-bs-original-title="Ubah Status"
                                                    type="submit">
                                                    @if ($data->status_pembayaran == 'Lunas')
                                                        {{ $data->status_pembayaran }}
                                                    @else
                                                        {{ $data->status_pembayaran }}
                                                    @endif
                                                </button>
                                            </form>

                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center justify-content-end">
                                                <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Detail" href="pendataans/{{ $data->id }}">
                                                    <span class="icon">
                                                        <span class="feather-icon"><i data-feather="eye"></i>
                                                        </span>
                                                    </span>
                                                </a>
                                                <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Edit" type="button"
                                                    href="pendataans/{{ $data->id }}/edit">
                                                    <span class="icon">
                                                        <span class="feather-icon"><i data-feather="edit-2"></i>
                                                        </span>
                                                    </span>
                                                </a>
                                                <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                    action="{{ route('pendataans.destroy',$data->id) }}" method="POST">
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
