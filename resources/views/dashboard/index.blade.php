@extends('layouts/main')
@section('title', 'Dashboard')

@section('content')
    <div class="hk-pg-wrapper">
        <div class="container-xxl">
            <!-- Page Header -->
            <div class="hk-pg-header pg-header-wth-tab pt-7">
                <div class="d-flex">
                    <div class="d-flex flex-wrap justify-content-between flex-1">
                        <div class="mb-lg-0 mb-2 me-8">
                            <h1 class="pg-title">Selamat Datang, {{ auth()->user()->nama }}!</h1>
                            <p>Sistem Pendataan Pengelolaan Air Minum Desa Kayuputih</p>
                        </div>
                        <div class="pg-header-action-wrap">
                            <div class="p-2 px-4 border border-light rounded-5">
                                <span class="input-affix-wrapper">
                                    <span>Periode Bulan: <b>{{ $namabulan }}</b></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Page Body -->
            <div class="hk-pg-body">

                <div class="col-6">
                    <select id="alternatifsFilter" class="form-select btn btn-soft-secondary text-start opacity-0"
                        aria-label="Default select example" style="width: 150px; position: absolute; left: -9999px;">
                        <option class="btn btn-soft-light text-start" value="">Semua</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-sm-4 col-12">
                        <div class="card card-sm mt-3">
                            <div class="hk-ribbon-type-1 overhead-start">
                                <span>Pelanggan</span>
                            </div>
                            <div class="card-body mt-4">
                                <div class="ps-3">
                                    <h5 class="card-title">Aktif <span class="badge badge-success badge-indicator"></span>
                                    </h5>
                                    <h3>
                                        <strong>{{ $pelangganAktif }}</strong> of {{ $pelanggan }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card card-sm mt-3">
                            <div class="hk-ribbon-type-1 overhead-start">
                                <span>Pendapatan</span>
                            </div>
                            <div class="card-body mt-4">
                                <h5 class="card-title">Total Pendapatan:</h5>
                                <h3 class="">Rp.{{ number_format($pendapatan, 0, ',', '.') }},-</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card card-sm mt-3">
                            <div class="hk-ribbon-type-1 overhead-start">
                                <span>Kritik & Saran</span>
                            </div>
                            <div class="card-body mt-4">
                                <h5 class="card-title">Belum dilihat: </h5>
                                <h3 class="">
                                    {{ $krisar }}
                                    @if ($krisar > 0)
                                        <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover pb-1"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                            data-bs-original-title="Lihat Kritik/Saran"
                                            href="{{ route('pengaduans.index') }}">
                                            <span class="icon">
                                                <span class="feather-icon">
                                                    <i data-feather="message-square" class=""></i>
                                                </span>
                                            </span>
                                        </a>
                                    @else
                                        <span>-</span>
                                    @endif
                                </h3>

                            </div>
                        </div>
                    </div>
                </div>


                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab_block_1">
                        <div class="row">
                            <div class="col-xxl-9 col-lg-8 col-md-7 mb-md-4 mb-3">
                                <div class="card card-border mb-0 h-100">
                                    <div class="card-header card-header-action">
                                        <h6>Statistik penggunaan air</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="text-center">
                                            <div class="d-inline-block ms-3">
                                                <span class="badge-status">
                                                    <span class="badge bg-sky badge-indicator badge-indicator-nobdr"></span>
                                                    <span class="badge-label">Penggunaan Air</span>
                                                </span>
                                            </div>
                                            {{-- <div class="d-inline-block ms-3">
                                                <span class="badge-status">
                                                    <span
                                                        class="badge bg-green badge-indicator badge-indicator-nobdr"></span>
                                                    <span class="badge-label">Pendapatan</span>
                                                </span>
                                            </div>
                                            <div class="d-inline-block ms-3">
                                                <span class="badge-status">
                                                    <span
                                                        class="badge bg-orange badge-indicator badge-indicator-nobdr"></span>
                                                    <span class="badge-label">Kritik dan Saran</span>
                                                </span>
                                            </div> --}}
                                        </div>
                                        <div id="chart_sispam1"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-lg-4 col-md-5 mb-md-4 mb-3">
                                <div class="card card-border mb-0  h-100">
                                    <div class="card-header card-header-action">
                                        <h6>Progres Pendataan</h6>

                                    </div>
                                    <div class="card-body text-center">
                                        <div id="progres_chart"></div>
                                        <div class="d-inline-block mt-4">
                                            <div class="mb-4">
                                                <span class="d-block badge-status lh-1">
                                                    <span
                                                        class="badge bg-primary badge-indicator badge-indicator-nobdr d-inline-block"></span>
                                                    <span class="badge-label d-inline-block">Jumlah Pendataan</span>
                                                </span>
                                                <span
                                                    class="d-block text-dark fs-5 fw-medium mb-0 mt-1">{{ $jumlahPendataan }}
                                                    / {{ $pelangganAktif }} Pelanggan</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-md-4 mb-3">
                                <div class="card card-border mb-0 h-100">
                                    <div class="card-header card-header-action">
                                        <h6>Pendataan Terbaru
                                            <span class="badge badge-sm badge-light ms-1">{{ $pendataanterbaru }}</span>
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-filter mb-0 filter" id="filterTable">
                                                <thead>
                                                    <tr>
                                                        <th class="mnw-50p opacity-50">#</th>
                                                        <th class="mnw-100p">Petugas</th>
                                                        <th class="mnw-150p">Pelanggan</th>
                                                        <th class="mnw-50p">Nilai Meteran(m<sup>3</sup>)</th>
                                                        <th class="mnw-50p">Penggunaan(m<sup>3</sup>)</th>
                                                        <th class="mnw-100p">Total Harga</th>
                                                        <th class="mnw-50p text-center">Status</th>
                                                        <th class="mnw-150p">Tanggal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($pendataanTable as $key => $data)
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>{{ $data->nama_petugas }}</td>
                                                            <td>{{ $data->nama_pelanggan }}</td>
                                                            <td>{{ $data->nilai_meteran }}</td>
                                                            <td>{{ $data->total_penggunaan }}</td>
                                                            <td>{{ $data->total_harga }}</td>
                                                            <td>
                                                                <form onsubmit="return confirm('Ingin mengubah status ?');"
                                                                    action="{{ url('/pendataans/status', [$data->id]) }}"
                                                                    method="post">
                                                                    @method('put')
                                                                    @csrf
                                                                    <button class="badge badge-primary badge-pill"
                                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                                        title="" data-bs-original-title="Ubah Status"
                                                                        type="submit">
                                                                        @if ($data->status_pembayaran == 'Lunas')
                                                                            {{ $data->status_pembayaran }}
                                                                        @else
                                                                            {{ $data->status_pembayaran }}
                                                                        @endif
                                                                    </button>
                                                                </form>
                                                            </td>
                                                            <td>{{ $data->created_at }}</td>
                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Body -->
        </div>
    </div>
@endsection

@push('script')
    <!-- Apex JS -->
    <script src="vendors/apexcharts/dist/apexcharts.min.js"></script>
    <script src="dist/js/column-chart-init.js"></script>
    {{-- <script>
        /*Basic*/
        var options = {
            series: [{
                name: 'Penggunaan Air',
                data: {!! json_encode($penggunaanPerbulan) !!}
            }, {
                name: 'Pendapatan (skala 1:1000)',
                data: {!! json_encode(
                    collect($pendapatanPerbulan)->map(function ($value) {
                        return $value / 1000;
                    }),
                ) !!}
            }, {
                name: 'Pelunasan',
                data: [35, 41, 36, 26, 45, 48, 52, 53, 41, 45, 33, 12]
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            },
            yaxis: {
                title: {
                    text: ''
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "" + val + ""
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart_sispam1"), options);
        chart.render();
    </script> --}}

    {{-- chart --}}
    <script>
        /*Basic*/
        var options = {
            series: [{
                name: 'Penggunaan Air',
                data: {!! json_encode($penggunaanPerbulan) !!}
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            },
            yaxis: {
                title: {
                    text: 'meter kubik'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " m<sup>3</sup>"
                    }
                }
            },
            colors: ['#80C959'],
        };

        var chart = new ApexCharts(document.querySelector("#chart_sispam1"), options);
        chart.render();
    </script>

    {{-- progress --}}
    <script>
        /*Gradient Chart*/
        var options3 = {
            series: [{{ $persentasiPendataanBulat }}],
            chart: {
                height: 350,
                type: 'radialBar',
                toolbar: {
                    show: true
                }
            },
            plotOptions: {
                radialBar: {
                    startAngle: -135,
                    endAngle: 225,
                    hollow: {
                        margin: 0,
                        size: '60%',
                        background: '#fff',
                        image: undefined,
                        imageOffsetX: 0,
                        imageOffsetY: 0,
                        position: 'front',
                        dropShadow: {
                            enabled: true,
                            top: 3,
                            left: 0,
                            blur: 4,
                            opacity: 0.24
                        }
                    },
                    track: {
                        background: '#fff',
                        strokeWidth: '67%',
                        margin: 0, // margin is in pixels
                        dropShadow: {
                            enabled: true,
                            top: -3,
                            left: 0,
                            blur: 4,
                            opacity: 0.35
                        }
                    },

                    dataLabels: {
                        show: true,
                        name: {
                            offsetY: -10,
                            show: true,
                            color: '#888',
                            fontSize: '17px'
                        },
                        value: {
                            formatter: function(val) {
                                return parseInt(val);
                            },
                            color: '#111',
                            fontSize: '36px',
                            show: true,
                        }
                    }
                }
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'dark',
                    type: 'horizontal',
                    shadeIntensity: 0.5,
                    gradientToColors: ['#ABE5A1'],
                    inverseColors: true,
                    opacityFrom: 1,
                    opacityTo: 1,
                    stops: [0, 100]
                }
            },
            stroke: {
                lineCap: 'round'
            },
            labels: ['Persen'],
            colors: ['#1ab7ea', '#0084ff', '#39539E', '#0077B5'],

        };

        var chart3 = new ApexCharts(document.querySelector("#progres_chart"), options3);
        chart3.render();
    </script>

    {{-- tabel --}}
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
                if ($($(this)).html() == "Pelanggan") {
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
@endpush
