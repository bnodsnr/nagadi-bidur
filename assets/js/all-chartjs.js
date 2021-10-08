
var Script = function () {
    var pieData = [
        {
            value: 30,
            color:"#F38630"
        },
        {
            value : 50,
            color : "#E0E4CC"
        },
        {
            value : 100,
            color : "#69D2E7"
        }

    ];
    var barChartData = {
        backgroundColor:"#000",
        options: {
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var label = data.datasets[tooltipItem.datasetIndex].label || '';

                        if (label) {
                            label += ': ';
                        }
                        label += Math.round(tooltipItem.yLabel * 100) / 100;
                        return label;
                    }
                }
            }
        },

        labels : ["वडा १","वडा २","वडा ३","वडा ४","वडा ५","वडा ६","वडा ७","वडा ८","वडा ९","वडा १०","वडा ११","वडा १२","वडा १३"],
        datasets : [
            {
                barPercentage: 0.5,
                barThickness: 6,
                maxBarThickness: 8,
                fillColor : "#F5DEB3",
                strokeColor : "rgba(220,220,220,1)",
                data : [65,59,90,81,56,55,40,40,40,40,40,40,40]
            },
            {
                barPercentage: 0.5,
                barThickness: 6,
                fillColor : "rgba(151,187,205,0.5)",
                strokeColor : "rgba(151,187,205,1)",
                data : [28,48,40,19,96,27,100,100,100,100,100,100,100]
            }
        ],
    };
    new Chart(document.getElementById("bar").getContext("2d")).Bar(barChartData);
    new Chart(document.getElementById("pie").getContext("2d")).Pie(pieData);


}();