// The speed gauge
var chartPH = Highcharts.chart(
    "container-PH",
    Highcharts.merge(
        {
            chart: {
                type: "solidgauge",
                backgroundColor: "transparent",
                width: 300,
                height: 300,
            },
            title: {
                text: "PH",
                style: {
                    color: "#c2c2d9",
                },
            },
            pane: {
                center: ["50%", "65%"],
                size: "100%",
                startAngle: -90,
                endAngle: 90,
                background: {
                    backgroundColor:
                        Highcharts.defaultOptions.legend.backgroundColor ||
                        "#EEE",
                    // backgroundColor: 'transparent',
                    innerRadius: "60%",
                    outerRadius: "100%",
                    shape: "arc",
                },
            },
            exporting: {
                enabled: false,
            },

            tooltip: {
                enabled: false,
            },
            // the value axis
            yAxis: {
                stops: [
                    [0.1, "#DF5353"], // green
                    [0.5, "#DDDF0D"], // yellow
                    [0.9, "#55BF3B"], // red
                ],
                lineWidth: 0,
                tickWidth: 0,
                minorTickInterval: null,
                tickAmount: 2,
                title: {
                    y: -70,
                },
                labels: {
                    y: 16,
                },
            },
            plotOptions: {
                solidgauge: {
                    dataLabels: {
                        y: 5,
                        borderWidth: 0,
                        useHTML: true,
                    },
                },
            },
        },
        {
            yAxis: {
                min: 0,
                max: 14,
            },
            credits: {
                enabled: false,
            },
            series: [
                {
                    name: "PH",
                    data: [0],
                    dataLabels: {
                        format:
                            '<div style="text-align:center">' +
                            '<span style="font-size:25px; color:#c2c2d9;">{y}</span><br/>' +
                            '<span style="font-size:12px;opacity:0.4;color:#c2c2d9;">PH</span>' +
                            "</div>",
                    },
                    tooltip: {
                        //
                    },
                },
            ],
        }
    )
);
var chartTDS = Highcharts.chart(
    "container-TDS",
    Highcharts.merge(
        {
            chart: {
                type: "solidgauge",
                backgroundColor: "transparent",
                width: 300,
                height: 300,
            },
            title: {
                text: "TDS",
                style: {
                    color: "#c2c2d9",
                },
            },
            pane: {
                center: ["50%", "65%"],
                size: "100%",
                startAngle: -90,
                endAngle: 90,
                background: {
                    backgroundColor:
                        Highcharts.defaultOptions.legend.backgroundColor ||
                        "#EEE",
                    // backgroundColor: 'transparent',
                    innerRadius: "60%",
                    outerRadius: "100%",
                    shape: "arc",
                },
            },
            exporting: {
                enabled: false,
            },

            tooltip: {
                enabled: false,
            },
            // the value axis
            yAxis: {
                stops: [
                    [0.1, "#DF5353"], // green
                    [0.5, "#DDDF0D"], // yellow
                    [0.9, "#55BF3B"], // red
                ],
                lineWidth: 0,
                tickWidth: 0,
                minorTickInterval: null,
                tickAmount: 2,
                title: {
                    y: -70,
                },
                labels: {
                    y: 16,
                },
            },
            plotOptions: {
                solidgauge: {
                    dataLabels: {
                        y: 5,
                        borderWidth: 0,
                        useHTML: true,
                    },
                },
            },
        },
        {
            yAxis: {
                min: 0,
                max: 1000,
            },

            credits: {
                enabled: false,
            },
            series: [
                {
                    name: "TDS",
                    data: [0],
                    dataLabels: {
                        format:
                            '<div style="text-align:center">' +
                            '<span style="font-size:25px; color:#c2c2d9;">{y}</span><br/>' +
                            '<span style="font-size:12px;opacity:0.4;color:#c2c2d9;">PPM</span>' +
                            "</div>",
                    },
                    tooltip: {
                        //
                    },
                },
            ],
        }
    )
);
var chartSUHU = Highcharts.chart(
    "container-SUHU",
    Highcharts.merge(
        {
            chart: {
                type: "solidgauge",
                backgroundColor: "transparent",
                width: 300,
                height: 300,
            },
            title: {
                text: "SUHU",
                style: {
                    color: "#c2c2d9",
                },
            },
            pane: {
                center: ["50%", "65%"],
                size: "100%",
                startAngle: -90,
                endAngle: 90,
                background: {
                    backgroundColor:
                        Highcharts.defaultOptions.legend.backgroundColor ||
                        "#EEE",
                    // backgroundColor: 'transparent',
                    innerRadius: "60%",
                    outerRadius: "100%",
                    shape: "arc",
                },
            },
            exporting: {
                enabled: false,
            },

            tooltip: {
                enabled: false,
            },
            // the value axis
            yAxis: {
                stops: [
                    [0.1, "#DF5353"], // green
                    [0.5, "#DDDF0D"], // yellow
                    [0.9, "#55BF3B"], // red
                ],
                lineWidth: 0,
                tickWidth: 0,
                minorTickInterval: null,
                tickAmount: 2,
                title: {
                    y: -70,
                },
                labels: {
                    y: 16,
                },
            },
            plotOptions: {
                solidgauge: {
                    dataLabels: {
                        y: 5,
                        borderWidth: 0,
                        useHTML: true,
                    },
                },
            },
        },
        {
            yAxis: {
                min: 0,
                max: 50,
            },

            credits: {
                enabled: false,
            },
            series: [
                {
                    name: "SUHU",
                    data: [0],
                    dataLabels: {
                        format:
                            '<div style="text-align:center">' +
                            '<span style="font-size:25px; color:#c2c2d9;">{y}</span><br/>' +
                            '<span style="font-size:12px;opacity:0.4;color:#c2c2d9;">&degC</span>' +
                            "</div>",
                    },
                    tooltip: {
                        //
                    },
                },
            ],
        }
    )
);
var chartKETINGGIANAIR = Highcharts.chart(
    "container-KetinggianAir",
    Highcharts.merge(
        {
            chart: {
                type: "solidgauge",
                backgroundColor: "transparent",
                width: 300,
                height: 300,
            },
            title: {
                text: "Ketinggian Air",
                style: {
                    color: "#c2c2d9",
                },
            },
            pane: {
                center: ["50%", "65%"],
                size: "100%",
                startAngle: -90,
                endAngle: 90,
                background: {
                    backgroundColor:
                        Highcharts.defaultOptions.legend.backgroundColor ||
                        "#EEE",
                    // backgroundColor: 'transparent',
                    innerRadius: "60%",
                    outerRadius: "100%",
                    shape: "arc",
                },
            },
            exporting: {
                enabled: false,
            },

            tooltip: {
                enabled: false,
            },
            // the value axis
            yAxis: {
                stops: [
                    [0.1, "#DF5353"], // green
                    [0.5, "#DDDF0D"], // yellow
                    [0.9, "#55BF3B"], // red
                ],
                lineWidth: 0,
                tickWidth: 0,
                minorTickInterval: null,
                tickAmount: 2,
                title: {
                    y: -70,
                },
                labels: {
                    y: 16,
                },
            },
            plotOptions: {
                solidgauge: {
                    dataLabels: {
                        y: 5,
                        borderWidth: 0,
                        useHTML: true,
                    },
                },
            },
        },
        {
            yAxis: {
                min: 0,
                max: 50,
            },

            credits: {
                enabled: false,
            },
            series: [
                {
                    name: "Ketinggian Air",
                    data: [0],
                    dataLabels: {
                        format:
                            '<div style="text-align:center">' +
                            '<span style="font-size:25px; color:#c2c2d9;">{y}</span><br/>' +
                            '<span style="font-size:12px;opacity:0.4;color:#c2c2d9;">CM</span>' +
                            "</div>",
                    },
                    tooltip: {
                        //
                    },
                },
            ],
        }
    )
);
