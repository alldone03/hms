@extends('pages.template')

@section('content')
    @push('title')
        History - @include('pages.component.title')
    @endpush
    @push('links')
        <link rel="shortcut icon" href="{{ asset('assets/compiled/svg/favicon.svg') }}" type="image/x-icon" />
        <link rel="shortcut icon"
            href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2tldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC"
            type="image/png" />
        <link rel="stylesheet" href="{{ asset('assets/compiled/css/app.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/compiled/css/app-dark.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/compiled/css/table-datatable-jquery.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" />
        {{-- Choise CSS --}}
        <link rel="stylesheet" href="{{ asset('assets/extensions/choices.js/public/assets/styles/choices.css') }}" />
        {{-- Datatables --}}
        <link rel="stylesheet"
            href="{{ asset('assets/extensions/datatables/cdn.datatables.net_buttons_2.4.2_css_buttons.dataTables.min.css') }}" />
    @endpush
    @push('scripts')
        <script src="{{ asset('assets/static/js/components/dark.js') }}"></script>
        <script src="{{ asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('assets/compiled/js/app.js') }}"></script>

        <script src="{{ asset('assets/js/extensions/code.jquery.com_jquery-3.7.1.js') }}"></script>
        <script src="{{ asset('assets/js/extensions/datatables.min.js') }}"></script>

        <script src="{{ asset('assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
        <script src="{{ asset('assets/js/pages/form-element-select.js') }}"></script>
        <script>
            @if (session()->has('success'))
                Toastify({
                    text: "{{ session('success') }}",
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#4fbe87",
                }).showToast()
            @endif
            function convertDateToIndonesianFormat(dateString) {
                const date = new Date(dateString);
                const day = date.getDate();
                const month = date.getMonth();
                const year = date.getFullYear();
                const hour = date.getHours();
                const minute = date.getMinutes();
                const second = date.getSeconds();


                const monthNames = [
                    "Januari",
                    "Februari",
                    "Maret",
                    "April",
                    "Mei",
                    "Juni",
                    "Juli",
                    "Agustus",
                    "September",
                    "Oktober",
                    "November",
                    "Desember",
                ];
                const indonesianMonthName = monthNames[month];


                const formattedDate =
                    `${day} ${indonesianMonthName} ${year} ${hour<10?"0"+hour:hour}:${minute<10?"0"+minute:minute}:${second<10?"0"+second:second}`;

                return formattedDate;
            }

            function toPage(params) {

                var device = $('#selectdevice').val();
                var startdate = $('#startdate').val();
                var enddate = $('#enddate').val();


                var no = 0;
                $('tbody').empty();
                $('.pagination').empty();
                $.ajax({
                    type: "get",
                    url: params,
                    data: {
                        _token: "{{ csrf_token() }}",
                        device: device,
                        startdate: startdate,
                        enddate: enddate,
                    },

                    success: function(data) {


                        JSON.parse(data).data.forEach(element => {
                            $('tbody').append('<tr><td>' + element.id + '</td><td>' +
                                element
                                .device.nama_device +
                                '</td><td>' + element
                                .ph +
                                '</td><td>' + element.tds + '</td><td>' +
                                element.suhu + '</td><td>' + element
                                .ketinggian_air +
                                '</td><td>' + String(
                                    convertDateToIndonesianFormat(element
                                        .created_at)) +
                                '</td></tr>')
                        });
                        JSON.parse(data).links.forEach(element => {
                            if (!(no == 0 && element.url == null)) {

                                var state = element.active == true ? 'active' : '';
                                $('.pagination').append(
                                    '<li class="page-item ' +
                                    state +
                                    `"><button class="page-link" onClick="toPage('` +
                                    element.url +
                                    `')" attr-data="` + element.label +
                                    '">' + element.label + '</button></li>')
                            }
                            no++;
                        })


                    }
                });

            }
            $(document).ready(function() {
                var date = new Date();
                var currentDate = date.toISOString().substring(0, 10);
                document.getElementById('enddate').value = currentDate;


                function convertDateToIndonesianFormat(dateString) {
                    const date = new Date(dateString);
                    const day = date.getDate();
                    const month = date.getMonth();
                    const year = date.getFullYear();
                    const hour = date.getHours();
                    const minute = date.getMinutes();
                    const second = date.getSeconds();


                    const monthNames = [
                        "Januari",
                        "Februari",
                        "Maret",
                        "April",
                        "Mei",
                        "Juni",
                        "Juli",
                        "Agustus",
                        "September",
                        "Oktober",
                        "November",
                        "Desember",
                    ];
                    const indonesianMonthName = monthNames[month];


                    const formattedDate =
                        `${day} ${indonesianMonthName} ${year} ${hour<10?"0"+hour:hour}:${minute<10?"0"+minute:minute}:${second<10?"0"+second:second}`;

                    return formattedDate;
                }

                $('#formsubmit').submit(function(e) {
                    e.preventDefault();
                    if ($('#submithistory').html() ==
                        '<div class="spinner-border text-light" role="status"></div>') {
                        alert("Please Wait!!!");
                        return
                    }
                    $('#submithistory').html('<div class="spinner-border text-light" role="status">');
                    var device = $('#selectdevice').val();
                    var startdate = $('#startdate').val();
                    var enddate = $('#enddate').val();


                    var no = 0;
                    $('tbody').empty();
                    $('.pagination').empty();
                    $.ajax({
                        type: "get",
                        url: "{{ route('historyget2') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            device: device,
                            startdate: startdate,
                            enddate: enddate,
                        },

                        success: function(data) {
                            $('#submithistory').html(
                                'Submit\n\n                                    '
                            )
                            JSON.parse(data).data.forEach(element => {
                                $('tbody').append('<tr><td>' + element.id + '</td><td>' +
                                    element
                                    .device.nama_device +
                                    '</td><td>' + element
                                    .ph +
                                    '</td><td>' + element.tds + '</td><td>' +
                                    element.suhu + '</td><td>' + element
                                    .ketinggian_air +
                                    '</td><td>' + String(
                                        convertDateToIndonesianFormat(element
                                            .created_at)) +
                                    '</td></tr>')
                            });
                            JSON.parse(data).links.forEach(element => {
                                if (!(no == 0 && element.url == null)) {

                                    var state = element.active == true ? 'active' : '';
                                    $('.pagination').append(
                                        '<li class="page-item ' +
                                        state +
                                        `"><button class="page-link" onClick="toPage('` +
                                        element.url +
                                        `')" attr-data="` + element.label +
                                        '">' + element.label + '</button></li>')
                                }
                                no++;
                            })


                        }
                    });

                });


            });
        </script>
    @endpush

    <script src="{{ asset('assets/static/js/initTheme.js') }}"></script>
    @extends('pages.layout')
@section('layout-content')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>History</h3>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form id="formsubmit">
                            <div class="row">
                                <div class="col-md-4">
                                    <h6 for="startdate">Select Device</h6>
                                    <div class="input-group mb-3">
                                        <label class="input-group-text" for="inputGroupSelect01">Select</label>
                                        <select class="form-select" name="selectdevice" id="selectdevice" required>

                                            @foreach ($device as $d)
                                                <option value="{{ $d['id'] }}">{{ $d['nama_device'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <h6 for="startdate">Start Date</h6>
                                    <input type="date" class="form-control" id="startdate" required>
                                </div>
                                <div class="col-md-4">
                                    <h6 for="enddate">End Date</h6>
                                    <input type="date" class="form-control" id="enddate" required>
                                </div>


                            </div>
                            <div class="row">

                                <div class="card-footer d-flex justify-content-end">
                                    <button class="btn btn-primary"id="submithistory" type="submit">Submit

                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>



        </div>

    </section>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">


                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Device</th>
                                <th>PH</th>
                                <th>TDS</th>
                                <th>SUHU</th>
                                <th>AIR</th>
                                <th>Waktu</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <div style="height: 10px"></div>
                    <div class="d-flex flex-row-reverse">

                        <nav aria-label="Page navigation example">
                            <ul class="pagination">


                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@endsection
