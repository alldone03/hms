const chartph = new Chart(document.getElementById("Chart-PH"), {
    type: "line",
    data: {
        labels: ["0"],
        datasets: [
            {
                label: "PH",
                data: [0],
                borderWidth: 1,
            },
        ],
    },

    options: {
        animations: false,
        scales: {
            y: {
                beginAtZero: true,
            },
        },
    },
});

const charttds = new Chart(document.getElementById("Chart-TDS"), {
    type: "line",
    data: {
        labels: ["0"],
        datasets: [
            {
                label: "TDS",
                data: [0],
                borderWidth: 1,
            },
        ],
    },
    options: {
        animations: false,
        scales: {
            y: {
                beginAtZero: true,
            },
        },
    },
});
const chartsuhu = new Chart(document.getElementById("Chart-SUHU"), {
    type: "line",
    data: {
        labels: ["0"],
        datasets: [
            {
                label: "SUHU",
                data: [0],
                borderWidth: 1,
            },
        ],
    },
    options: {
        animations: false,
        scales: {
            y: {
                beginAtZero: true,
            },
        },
    },
});

const charttinggiair = new Chart(
    document.getElementById("Chart-ketinggianair"),
    {
        type: "line",
        data: {
            labels: ["0"],
            datasets: [
                {
                    label: "CM",
                    data: [0],
                    borderWidth: 1,
                },
            ],
        },

        options: {
            animations: false,
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    }
);
