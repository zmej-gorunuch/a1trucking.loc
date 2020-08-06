var f=document.getElementById("lineChart");
new Chart(f, {
    type:"line", data: {
        labels:["Січень", "Лютий", "Березень", "Квітень", "Травень", "Червень", "Липень", "Серпень", "Вересень", "Жовтень", "Листопад", "Грудень"],
        datasets:[ {
            label: "Унікальні відвідувачі",
            backgroundColor: "rgba(38, 185, 154, 0.31)",
            borderColor: "rgba(38, 185, 154, 0.7)",
            pointBorderColor: "rgba(38, 185, 154, 0.7)",
            pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
            pointHoverBackgroundColor: "#fff",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointBorderWidth: 1,
            data: [31, 74, 6, 39, 20, 85, 7, 12, 54, 12, 16, 19]
        }, {
            label: "Кількість відвідувань",
            backgroundColor: "rgba(3, 88, 106, 0.3)",
            borderColor: "rgba(3, 88, 106, 0.70)",
            pointBorderColor: "rgba(3, 88, 106, 0.70)",
            pointBackgroundColor: "rgba(3, 88, 106, 0.70)",
            pointHoverBackgroundColor: "#fff",
            pointHoverBorderColor: "rgba(151,187,205,1)",
            pointBorderWidth: 1,
            data: [82, 23, 66, 9, 99, 4, 23, 74, 6, 39, 20, 85]
            }
        ]
    }
});

var f=document.getElementById("mybarChart");
new Chart(f, {
    type:"bar", data: {
        labels:["January", "February", "March", "April", "May", "June", "July"],
        datasets:[
            {
                label: "# of Votes",
                backgroundColor: "#26B99A",
                data: [51, 30, 40, 28, 92, 50, 45]
            },
            {
                label: "# of Votes",
                backgroundColor: "#03586A",
                data: [41, 56, 25, 48, 72, 34, 12]
            }
        ]
    },
    options: {
        scales: {
            yAxes:[{
                ticks: {
                    beginAtZero: !0
                }
            }]
        }
    }
});