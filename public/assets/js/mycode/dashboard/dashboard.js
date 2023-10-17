var dataph = [];
var datatds = [];
var datasuhu = [];
var dataketinggianair = [];
var time = [];
var btncontrol = [0, 0, 0, 0, 0, 0, 0];
var controlrelayname = [
    "Auto",
    "PH UP",
    "PH Down",
    "UP A",
    "UP B",
    "Distribusi Air",
    "Pompa",
];
$(document).ready(function () {
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

        const formattedDate = `${day} ${indonesianMonthName} ${year} ${
            hour < 10 ? "0" + hour : hour
        }:${minute < 10 ? "0" + minute : minute}:${
            second < 10 ? "0" + second : second
        }`;

        return formattedDate;
    }
    $(".mybtncontrol").click(function (e) {
        e.preventDefault();
        var id = $(this).attr("mybtn-attr-id");

        btncontrol[id] = btncontrol[id] == 0 ? 1 : 0;
        if (id == 0) {
            Toastify({
                text:
                    controlrelayname[id] +
                    " " +
                    `${btncontrol[id] == 0 ? "ON" : "OFF"}`,
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: btncontrol[id] == 0 ? "#4fbe87" : "#dc3545",
            }).showToast();
        } else {
            Toastify({
                text:
                    controlrelayname[id] +
                    " " +
                    `${btncontrol[id] != 1 ? "ON" : "OFF"}`,
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: btncontrol[id] != 1 ? "#4fbe87" : "#dc3545",
            }).showToast();
        }
    });
    $("#selectdevice").change(function () {
        btncontrol = [0, 0, 0, 0, 0, 0, 0];
        btncontrol.forEach((element, index) => {
            $(`.mybtncontrol[mybtn-attr-id="${index}"]`)
                .removeClass("btn-outline-danger")
                .removeClass("btn-outline-success")
                .addClass("btn-outline-secondary");
        });
        $.ajax({
            type: "GET",
            dataType: "json",
            data: {
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            url: myserver + "/dashboard/getdata/" + $("#selectdevice").val(),
            success: function (data) {
                data.datarelay.forEach((element, index) => {
                    btncontrol[index] = data.datarelay[index];
                    $(`.mybtncontrol[mybtn-attr-id="${index}"]`)
                        .removeClass("btn-outline-danger")
                        .removeClass("btn-outline-success")
                        .addClass("btn-outline-secondary");
                });
            },
        });
        if (chartPH) {
            chartPH.series[0].points[0].update(0.0);
        }
        if (chartTDS) {
            chartTDS.series[0].points[0].update(parseFloat(0));
        }
        if (chartSUHU) {
            chartSUHU.series[0].points[0].update(parseFloat(0.0));
        }

        chartph.data.labels = [0];
        charttds.data.labels = [0];
        chartsuhu.data.labels = [0];
        charttinggiair.data.labels = [0];

        chartph.data.datasets[0].data = [0];
        charttds.data.datasets[0].data = [0];
        chartsuhu.data.datasets[0].data = [0];
        charttinggiair.data.datasets[0].data = [0];
        charttds.update();
        chartsuhu.update();
        chartph.update();
        charttinggiair.update();
    });
    setInterval(function () {
        var today = new Date();
        const data_ph = 0;
        const data_tds = 0;
        const data_suhu = 0;
        const data_ketinggianair = 0;
        if ($("#selectdevice").val() != 0) {
            $.ajax({
                type: "GET",
                dataType: "json",
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                    buttonstate: btncontrol,
                },

                url:
                    myserver + "/dashboard/getdata/" + $("#selectdevice").val(),
                success: function (data) {
                    data.datarelay.forEach((element, index) => {
                        if (element == "1") {
                            $(`.mybtncontrol[mybtn-attr-id="${index}"]`)
                                .removeClass("btn-outline-secondary")
                                .removeClass("btn-outline-danger")
                                .addClass("btn-outline-success");
                        } else {
                            $(`.mybtncontrol[mybtn-attr-id="${index}"]`)
                                .removeClass("btn-outline-secondary")
                                .removeClass("btn-outline-success")
                                .addClass("btn-outline-danger");
                        }
                    });

                    var dataph = data.ph;
                    var datatds = data.tds;
                    var datasuhu = data.suhu;
                    var dataketinggianair = data.ketinggian_air;
                    var time = [];

                    if (chartPH) {
                        chartPH.series[0].points[0].update(
                            parseFloat(dataph[0])
                        );
                    }
                    if (chartTDS) {
                        chartTDS.series[0].points[0].update(
                            parseFloat(datatds[0])
                        );
                    }
                    if (chartSUHU) {
                        chartSUHU.series[0].points[0].update(
                            parseFloat(datasuhu[0])
                        );
                    }
                    if (chartKETINGGIANAIR) {
                        chartKETINGGIANAIR.series[0].points[0].update(
                            parseFloat(dataketinggianair[0])
                        );
                    }

                    data.created_at.forEach((element) => {
                        time.push(convertDateToIndonesianFormat(element));
                    });

                    dataph.reverse();
                    datatds.reverse();
                    datasuhu.reverse();
                    dataketinggianair.reverse();
                    time.reverse();

                    chartph.data.labels = time;
                    charttds.data.labels = time;
                    chartsuhu.data.labels = time;
                    charttinggiair.data.labels = time;

                    chartph.data.datasets[0].data = dataph;
                    charttds.data.datasets[0].data = datatds;
                    chartsuhu.data.datasets[0].data = datasuhu;
                    charttinggiair.data.datasets[0].data = dataketinggianair;
                    charttds.update();
                    chartsuhu.update();
                    chartph.update();
                    charttinggiair.update();
                },
            });
        }

        //chart update
    }, 2000);
});
