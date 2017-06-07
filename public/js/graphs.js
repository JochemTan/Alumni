//main variables used by all functions
var chartData; //array[[labels],[data]]
var valueType = '';
var dataType = 'location';
var chartType = 'bar';

$(document).ready(function () {

    setTypeValuesFromCookie();
    getData();

    //data type selector listner
    $('#dataTypeSelect').change(function () {
        /* setting currently changed option value to option variable */
        var option = $(this).find('option:selected').val();
        /* fetching the data also calls update when data recieved */
        dataType = option;
        getData();

    });

    //chart selector listner
    $('#chartTypeSelect').change(function () {
        /* setting currently changed option value to option variable */
        var option = $(this).find('option:selected').val();
        /* setting input box value to selected option value */
        chartType = option;
        updateChart();
    });

    //chart selector listner
    $('#dataValuesSelect').change(function () {
        /* setting currently changed option value to option variable */
        var option = $(this).find('option:selected').val();
        /* setting input box value to selected option value */
        valueType = option;
        getData();
    });

});


function setTypeValuesFromCookie() {
    var graphPrefs = getCookie("graphPrefs");
    if (graphPrefs != "") {
        var graphPrefsArray = graphPrefs.split(",")
        $('#dataTypeSelect').val(graphPrefsArray[0]);
        $('#dataValuesSelect').val(graphPrefsArray[1]);
        $('#chartTypeSelect').val(graphPrefsArray[2]);
        dataType = graphPrefsArray[0];
        valueType = graphPrefsArray[1];
        chartType = graphPrefsArray[2];
        console.log(graphPrefsArray);
    } else {
        dataType = $('#dataTypeSelect').val();
        valueType = $('#dataValuesSelect').val();
        chartType = $('#chartTypeSelect').val();
    }
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function updateChart() {
    document.cookie = "graphPrefs="+dataType+","+valueType+","+chartType+"; path=/"
    setChart(chartType, chartData[0], chartData[1])
}

function getData() {
    $.get("statistics/"+ dataType +'/'+ valueType + location.search, function (data) {
        //console.log(data.data);
        var labels = Object.keys(data.data).map(function (k) {
            if (k == null || k == "") {
                return "Overig";
            } else {
                return k;
            }
        });
        var totals = $.map(data.data, function (el) {
            return el;
        });
        chartData = [labels, totals];
        updateChart();
    });

}
function generateColors(amount) {
    return randomColor({
        // luminosity: 'bright',
        count: amount
    });
}


function setChart(chartType, labels, data,colors) {
    var color;
    var colors;
    var showLabels = true;
    var showLegenda = false;
    if (chartType == "pie" || chartType == "radar" ||chartType == "doughnut" ||chartType == "polarArea") {
        showLabels = false;
    }
    if (chartType == "line" ||chartType == "radar") {
        color =  'rgb(221,147,26)';
        colors = 'rgba(221,147,26,0.5)';
    }else {
        color = 'rgba(0, 0, 0,0)';
        colors = generateColors(data.length);
    }

    $('#results-graph').replaceWith('<canvas id="results-graph" width="vh" height="vw"></canvas>');
    var ctx = $('#results-graph');
    var myChart = new Chart(ctx, {
        type: chartType,
        data: {
            labels: labels,
            datasets: [{
                label: "aantal alumni",
                data: data,
                borderColor: color,
                backgroundColor: colors,
                lineTension: 0
            }]
        },
        options: {
            legend: {
                display: showLegenda,
                labels: {
                    fontColor: 'rgb(0, 0, 0)'
                }
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        display: showLabels

                    }
                }],
                xAxes: [{
                    ticks: {
                        beginAtZero: true,
                        display: showLabels

                    }
                }]
            }
        }
    });
}