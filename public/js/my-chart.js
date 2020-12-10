var chartCategory = document.getElementById("myChartBarCategory");
var chartUser = document.getElementById("myChartBarCreator");

var myChartCategory = new Chart(chartCategory, {
    type: 'bar',
    data: dataBarCategory,
    options: {
        responsive: true,
        title: {
            display: true,
            text: 'Nombre de publications par catégories'
        },
        legend: {
            display: false
        },
        "hover": {
            "animationDuration": 0
        },
        "animation": {
            "duration": 1,
            "onComplete": function () {
                var chartInstance = this.chart,
                    ctx = chartInstance.ctx;

                ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                ctx.textAlign = 'center';
                ctx.textBaseline = 'bottom';

                this.data.datasets.forEach(function (dataset, i) {
                    var meta = chartInstance.controller.getDatasetMeta(i);
                    meta.data.forEach(function (bar, index) {
                        var data = dataset.data[index];
                        ctx.fillText(data, bar._model.x, bar._model.y - 5);
                    });
                });
            }
        },
        scales: {
            yAxes: [{
                ticks: {
                    max: Math.max(...dataBarCategory.datasets[0].data) + 10,
                    beginAtZero: true
                },
                scaleLabel: {
                    display: true,
                    labelString: 'Nbre de publications'
                },
            }],
            xAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'Catégories'
                },
            }]
        }
    }
});

var myChartUser = new Chart(chartUser, {
    type: 'bar',
    data: dataBarUser,
    options: {
        responsive: true,
        title: {
            display: true,
            text: 'Nombre d\'articles publiés par l\'utilisateur'
        },
        legend: {
            display: false
        },
        "hover": {
            "animationDuration": 0
        },
        "animation": {
            "duration": 1,
            "onComplete": function () {
                var chartInstance = this.chart,
                    ctx = chartInstance.ctx;

                ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                ctx.textAlign = 'center';
                ctx.textBaseline = 'bottom';

                this.data.datasets.forEach(function (dataset, i) {
                    var meta = chartInstance.controller.getDatasetMeta(i);
                    meta.data.forEach(function (bar, index) {
                        var data = dataset.data[index];
                        ctx.fillText(data, bar._model.x, bar._model.y - 5);
                    });
                });
            }
        },
        scales: {
            yAxes: [{
                ticks: {
                    max: Math.max(...dataBarUser.datasets[0].data) + 10,
                    beginAtZero: true
                },
                scaleLabel: {
                    display: true,
                    labelString: 'Nbre de publications'
                },
            }],
            xAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'Utilisateurs'
                },
            }]
        }
    }
});
