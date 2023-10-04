@extends('pages.template')

@section('content')
    @push('title')
        Dashboard Admin - @include('pages.component.title')
    @endpush
    @push('links')
        <link rel="shortcut icon" href="{{ asset('assets/compiled/svg/favicon.svg') }}" type="image/x-icon" />
        <link rel="shortcut icon"
            href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2tldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC"
            type="image/png" />
        <link rel="stylesheet" href="{{ asset('assets/compiled/css/app.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/compiled/css/app-dark.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/extensions/toastify-js/src/toastify.css') }}" />
        <style>
            .progress-bar-vertical {
                width: 52px;
                min-height: 269px;
                margin-right: 20px;
                border-radius: 10px !important;
                display: flex;
                flex-direction: column-reverse;

            }

            .progress-bar-vertical .progress-bar {
                width: 100%;
                height: 0;
                -webkit-transition: height 0.6s ease;
                -o-transition: height 0.6s ease;
                transition: height 0.6s ease;

                display: block;
            }

            @keyframes grow {
                from {
                    transform: scaleY(0);
                }
            }
        </style>
    @endpush
    @push('scripts')
        <script src="{{ asset('assets/static/js/components/dark.js') }}"></script>
        <script src="{{ asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('assets/js/extensions/code.jquery.com_jquery-3.7.1.js') }}"></script>
        <script src="{{ asset('assets/compiled/js/app.js') }}"></script>
        <script src="{{ asset('assets/extensions/toastify-js/src/toastify.js') }}"></script>


        {{-- Gauge --}}
        <script src="{{ asset('assets/js/extensions/Gauge/highcharts.js') }}"></script>
        <script src="{{ asset('assets/js/extensions/Gauge/highcharts-more.js') }}"></script>
        <script src="{{ asset('assets/js/extensions/Gauge/solid-gauge.js') }}"></script>
        <script src="{{ asset('assets/js/extensions/Gauge/exporting.js') }}"></script>
        <script src="{{ asset('assets/js/extensions/Gauge/export-data.js') }}"></script>
        <script src="{{ asset('assets/js/extensions/Gauge/accessibility.js') }}"></script>


        {{-- ----- --}}
        {{-- Chart --}}


        <script src="{{ asset('assets/js/extensions/Chart/chart.js') }}"></script>
        {{-- ----- --}}

        <script>
            // The speed gauge
            var chartPH = Highcharts.chart('container-PH', Highcharts.merge({
                chart: {
                    type: 'solidgauge',
                    backgroundColor: 'transparent',
                    width: 300,
                    height: 300,
                },
                title: {
                    text: 'PH',
                    style: {
                        color: '#c2c2d9',
                    },
                },
                pane: {
                    center: ['50%', '65%'],
                    size: '100%',
                    startAngle: -90,
                    endAngle: 90,
                    background: {
                        backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || '#EEE',
                        // backgroundColor: 'transparent',
                        innerRadius: '60%',
                        outerRadius: '100%',
                        shape: 'arc'
                    }
                },
                exporting: {
                    enabled: false
                },

                tooltip: {
                    enabled: false
                },
                // the value axis
                yAxis: {
                    stops: [
                        [0.1, '#DF5353'], // green
                        [0.5, '#DDDF0D'], // yellow
                        [0.9, '#55BF3B'] // red
                    ],
                    lineWidth: 0,
                    tickWidth: 0,
                    minorTickInterval: null,
                    tickAmount: 2,
                    title: {
                        y: -70
                    },
                    labels: {
                        y: 16
                    }
                },
                plotOptions: {
                    solidgauge: {
                        dataLabels: {
                            y: 5,
                            borderWidth: 0,
                            useHTML: true
                        }
                    }
                }
            }, {
                yAxis: {
                    min: 0,
                    max: 14,

                },
                credits: {
                    enabled: false
                },
                series: [{
                    name: 'PH',
                    data: [0],
                    dataLabels: {
                        format: '<div style="text-align:center">' +
                            '<span style="font-size:25px; color:#c2c2d9;">{y}</span><br/>' +
                            '<span style="font-size:12px;opacity:0.4;color:#c2c2d9;">PH</span>' +
                            '</div>'
                    },
                    tooltip: {
                        //
                    }
                }]
            }));
            var chartTDS = Highcharts.chart('container-TDS', Highcharts.merge({
                chart: {
                    type: 'solidgauge',
                    backgroundColor: 'transparent',
                    width: 300,
                    height: 300,
                },
                title: {
                    text: 'TDS',
                    style: {
                        color: '#c2c2d9',
                    },
                },
                pane: {
                    center: ['50%', '65%'],
                    size: '100%',
                    startAngle: -90,
                    endAngle: 90,
                    background: {
                        backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || '#EEE',
                        // backgroundColor: 'transparent',
                        innerRadius: '60%',
                        outerRadius: '100%',
                        shape: 'arc'
                    }
                },
                exporting: {
                    enabled: false
                },

                tooltip: {
                    enabled: false
                },
                // the value axis
                yAxis: {
                    stops: [
                        [0.1, '#DF5353'], // green
                        [0.5, '#DDDF0D'], // yellow
                        [0.9, '#55BF3B'] // red
                    ],
                    lineWidth: 0,
                    tickWidth: 0,
                    minorTickInterval: null,
                    tickAmount: 2,
                    title: {
                        y: -70
                    },
                    labels: {
                        y: 16
                    }
                },
                plotOptions: {
                    solidgauge: {
                        dataLabels: {
                            y: 5,
                            borderWidth: 0,
                            useHTML: true
                        }
                    }
                }
            }, {
                yAxis: {
                    min: 0,
                    max: 14,

                },

                credits: {
                    enabled: false
                },
                series: [{
                    name: 'TDS',
                    data: [0],
                    dataLabels: {
                        format: '<div style="text-align:center">' +
                            '<span style="font-size:25px; color:#c2c2d9;">{y}</span><br/>' +
                            '<span style="font-size:12px;opacity:0.4;color:#c2c2d9;">PPM</span>' +
                            '</div>'
                    },
                    tooltip: {
                        //
                    }
                }]
            }));
            var chartSUHU = Highcharts.chart('container-SUHU', Highcharts.merge({
                chart: {
                    type: 'solidgauge',
                    backgroundColor: 'transparent',
                    width: 300,
                    height: 300,
                },
                title: {
                    text: 'SUHU',
                    style: {
                        color: '#c2c2d9',
                    },
                },
                pane: {
                    center: ['50%', '65%'],
                    size: '100%',
                    startAngle: -90,
                    endAngle: 90,
                    background: {
                        backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || '#EEE',
                        // backgroundColor: 'transparent',
                        innerRadius: '60%',
                        outerRadius: '100%',
                        shape: 'arc'
                    }
                },
                exporting: {
                    enabled: false
                },

                tooltip: {
                    enabled: false
                },
                // the value axis
                yAxis: {
                    stops: [
                        [0.1, '#DF5353'], // green
                        [0.5, '#DDDF0D'], // yellow
                        [0.9, '#55BF3B'] // red
                    ],
                    lineWidth: 0,
                    tickWidth: 0,
                    minorTickInterval: null,
                    tickAmount: 2,
                    title: {
                        y: -70
                    },
                    labels: {
                        y: 16
                    }
                },
                plotOptions: {
                    solidgauge: {
                        dataLabels: {
                            y: 5,
                            borderWidth: 0,
                            useHTML: true
                        }
                    }
                }
            }, {
                yAxis: {
                    min: 0,
                    max: 14,

                },

                credits: {
                    enabled: false
                },
                series: [{
                    name: 'SUHU',
                    data: [0],
                    dataLabels: {
                        format: '<div style="text-align:center">' +
                            '<span style="font-size:25px; color:#c2c2d9;">{y}</span><br/>' +
                            '<span style="font-size:12px;opacity:0.4;color:#c2c2d9;">&degC</span>' +
                            '</div>'
                    },
                    tooltip: {
                        //
                    }
                }]
            }));
        </script>
        <script>
            const chartph = new Chart(document.getElementById('Chart-PH'), {
                type: 'line',
                data: {
                    labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                    datasets: [{
                        label: 'PH',
                        data: [12, 19, 3, 5, 2, 3],
                        borderWidth: 1
                    }]
                },

                options: {
                    animations: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            const charttds = new Chart(document.getElementById('Chart-TDS'), {
                type: 'line',
                data: {
                    labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                    datasets: [{
                        label: 'TDS',
                        data: [12, 19, 3, 5, 2, 3],
                        borderWidth: 1
                    }]
                },
                options: {
                    animations: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            const chartsuhu = new Chart(document.getElementById('Chart-SUHU'), {
                type: 'line',
                data: {
                    labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                    datasets: [{
                        label: 'SUHU',
                        data: [12, 19, 3, 5, 2, 3],
                        borderWidth: 1
                    }]
                },
                options: {
                    animations: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>

        <script>
            var dataph = [];
            var datatds = [];
            var datasuhu = [];
            var time = [];

            setInterval(function() {
                // Speed
                var today = new Date();
                const data_ph = (Math.random(0, 14) * 10).toFixed(2);
                const data_tds = (Math.random(0, 14) * 10).toFixed(2);
                const data_suhu = (Math.random(0, 14) * 10).toFixed(2);

                if (chartPH) {
                    chartPH.series[0].points[0].update(parseFloat(data_ph));
                }
                if (chartTDS) {
                    chartTDS.series[0].points[0].update(parseFloat(data_tds));
                }
                if (chartSUHU) {
                    chartSUHU.series[0].points[0].update(parseFloat(data_suhu));
                }

                time.push(today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate() + " " + today
                    .getHours() + ":" + today.getMinutes() + ":" + today.getSeconds());
                if (dataph.length > 10) {
                    dataph.reverse();
                    dataph.pop();
                    dataph.reverse();

                    datatds.reverse();
                    datatds.pop();
                    datatds.reverse();

                    datasuhu.reverse();
                    datasuhu.pop();
                    datasuhu.reverse();


                    time.reverse();
                    time.pop();
                    time.reverse();
                }
                dataph.push(parseFloat(data_ph));
                datatds.push(parseFloat(data_tds));
                datasuhu.push(parseFloat(data_suhu));



                chartph.data.labels = time;
                charttds.data.labels = time;
                chartsuhu.data.labels = time;

                chartph.data.datasets[0].data = dataph;
                charttds.data.datasets[0].data = datatds;
                chartsuhu.data.datasets[0].data = datasuhu;
                charttds.update();
                chartsuhu.update();
                chartph.update();

                //chart update

            }, 2000);
        </script>
    @endpush
    <script src="{{ asset('assets/static/js/initTheme.js') }}"></script>
    @extends('pages.layout')
@section('layout-content')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Dashboard</h3>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="row">


            <div class="col-sm-12 col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div id="container-PH" class="chart-container"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div id="container-TDS" class="chart-container"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div id="container-SUHU" class="chart-container"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-3">
                <div class="card">
                    <div class="card-body">

                        <div class="row">

                            <h5 class="card-title" style="text-align: center">Ketinggian Air</h5>
                        </div>


                        <div class="flex row justify-content-center">

                            <div class="col-md-2 col-lg-2">
                                <div class="progress progress-bar-vertical">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60"
                                        aria-valuemin="0" aria-valuemax="100" style="height: 60%;">
                                        <span class="sr-only">60%</span>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>

        </div>


    </section>
    <section>
        <div class="row">

            <div class="row">

                <div class="col-sm-12 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Graph PH</h5>
                            <div class="row justify-content-center">
                                <canvas id="Chart-PH"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Graph TDS</h5>
                            <div class="row justify-content-center">
                                <canvas id="Chart-TDS"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-sm-12 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Graph SUHU</h5>
                            <div class="row justify-content-center">
                                <canvas id="Chart-SUHU"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Control Relay</h5>
                    <div class="row justify-content-around">
                        <div class="col-sm-12 col-md-2">
                            <button class="btn btn-outline-danger btnmasuk" style=" height: 200px; width:200px">
                                PH UP
                            </button>
                        </div>
                        <div class="col-sm-12 col-md-2">
                            <button class="btn btn-outline-danger btnkeluar" style=" height: 200px; width:200px">
                                PH DOWN
                            </button>
                        </div>
                        <div class="col-sm-12 col-md-2">
                            <button class="btn btn-outline-danger btnkeluar" style=" height: 200px; width:200px">
                                UP A
                            </button>
                        </div>
                        <div class="col-sm-12 col-md-2">
                            <button class="btn btn-outline-danger btnkeluar" style=" height: 200px; width:200px">
                                UP B
                            </button>
                        </div>
                        <div class="col-sm-12 col-md-2">
                            <button class="btn btn-outline-danger btnkeluar" style=" height: 200px; width:200px">
                                Distribusi Air
                            </button>
                        </div>
                        <div class="col-sm-12 col-md-2">
                            <button class="btn btn-outline-danger btnkeluar" style=" height: 200px; width:200px">
                                Pompa
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </section>
@endsection
@endsection
