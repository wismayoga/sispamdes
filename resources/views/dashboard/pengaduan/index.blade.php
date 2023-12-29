@extends('layouts.main')
@section('title', 'Kritik dan Saran')

@section('content')
    <div class="hk-pg-wrapper">
        <div class="container-xxl">

            <!-- Page Header -->
            <div class="hk-pg-header pg-header-wth-tab pt-7">
                <div class="d-flex">
                    <div class="d-flex flex-wrap justify-content-between flex-1">
                        <div class="mb-lg-0 mb-2 me-8">
                            <h1 class="pg-title">Kritik dan Saran</h1>
                            <p>Dashboard / Kritik dan Saran</p>
                        </div>
                        {{-- <div class="pg-header-action-wrap">
                            <div class="input-group w-300p">
                                <span class="input-affix-wrapper">
                                    <span class="input-prefix"><span class="feather-icon">
                                            <i data-feather="calendar"></i></span></span>
                                    <input class="form-control form-wth-icon" name="datetimes"
                                        value="Aug 18,2020 - Aug 19, 2020">
                                </span>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Page Body -->
            <div class="hk-pg-body">

                <div id="radial_chart_4"></div>

                <div class="table-responsive mt-3">
                    <select id="alternatifsFilter" class="form-select btn btn-soft-secondary text-start opacity-0" 
                        aria-label="Default select example" style="width: 150px; position: absolute; left: -9999px;">
                        <option class="btn btn-soft-light text-start" value="">Semua</option>
                    </select>
                    <table class="table table-hover table-filter mb-0" id="filterTable">
                        <thead>
                            <tr>
                                {{-- <th class="mnw-50p">#</th> --}}
                                <th class="mnw-50p">#</th>
                                {{-- <th class="mnw-50p">Id Pelanggan</th> --}}
                                <th class="mnw-100p">Nama</th>
                                <th class="mnw-100p">Tanggal</th>
                                <th class="mnw-50p">Nomor HP</th>
                                <th class="mnw-200p">Kritik Saran</th>
                                <th class="mnw-50p  text-center">Status</th>
                                <th class=""></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengaduans as $key => $pengaduan)
                                <tr>
                                    <td class="text-truncate mnw-50p">{{ $key + 1 }}</td>
                                    {{-- <td class="text-truncate mnw-50p">{{ $pengaduan->id_pelanggan }}</span></td> --}}
                                    <td class="text-truncate">{{ $pengaduan->nama }}</span></td>
                                    <td class="text-truncate">{{ \Carbon\Carbon::parse($pengaduan->created_at)->translatedFormat('l, d M Y', 'id') }}</td>
                                    <td class="text-truncate">{{ $pengaduan->nomor_hp }}</span></td>
                                    <td class="text-truncate">{{ $pengaduan->pengaduan }}</span></td>
                                    <td class="text-truncate text-center">
                                        @if ($pengaduan->status_pengaduan == 'Belum Dilihat')
                                            <span class="badge badge-primary badge-pill">
                                                {{ $pengaduan->status_pengaduan }}
                                            </span>
                                        @else
                                            <span class="badge badge-secondary badge-pill">
                                                {{ $pengaduan->status_pengaduan }}
                                            </span>
                                        @endif
                                    <td>
                                        <div class="d-flex align-items-center justify-content-end">
                                            <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                data-bs-original-title="Lihat Kritik/Saran"
                                                href="pengaduans/{{ $pengaduan->id }}">
                                                <span class="icon">
                                                    <span class="feather-icon">
                                                        @if ($pengaduan->status_pengaduan == 'Belum Dilihat')
                                                            <i data-feather="eye" class="text-primary"></i>
                                                        @else
                                                            <i data-feather="eye"></i>
                                                        @endif
                                                    </span>
                                                </span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach ($harga as $harga)
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{-- {{ $pengaduans->links() }} --}}
                    </div>
                </div>

            </div>
            <!-- /Page Body -->
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

<script>
    $("document").ready(function() {
        $("#filterTable").dataTable({
            "searching": true,
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
            if ($($(this)).html() == "Nama") {
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
