/**
 * Created by tahaturk25 on 6.9.2017.
 */
var donut = google.charts;
var column =google.charts;
    donut.load("current", {packages:["corechart"]});
    column.load("current", {packages:["bar"]});

donut.setOnLoadCallback(drawChart);
column.setOnLoadCallback(drawChart1);
function drawChart1(){
    var data3 = google.visualization.arrayToDataTable([
        ['', 'All Users',"Admin Users","User Users","Users are Employee","Users are not Employee"],
        ['Users',
            widgetcontent.allUsers,
            widgetcontent.adminUsers,
            widgetcontent.userUsers,
            widgetcontent.employeedUsers,
            widgetcontent.notEmployeedUsers
        ]

    ]);

    var options3 = {
        chart: {
            title: '',
            subtitle: ''
        }
    };

    var chart3 = new google.charts.Bar(document.getElementById('columnchart_material'));
    chart3.draw(data3, google.charts.Bar.convertOptions(options3));
}
function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ['Employees', 'Status'],
        ['All', widgetcontent.allEmployees],
        ['Active',  widgetcontent.activeEmployees]
    ]);

    var options = {
        title: 'Employees',
        pieHole: 0.1
    };


    var data1 = google.visualization.arrayToDataTable([
        ['Departments', 'Status'],
        ['Active',  widgetcontent.activeDepartments],
        ['All'   ,  widgetcontent.allDepartments]
    ]);

    var options1 = {
        title: 'Department',
        pieHole: 0.1
    };
    var data2 = google.visualization.arrayToDataTable([
        ['Degrees', 'Status'],
        ['Active' ,  widgetcontent.allDegrees],
        ['All'    ,  widgetcontent.activeDegree]


    ]);

    var options2 = {
        title: 'Degrees',
        pieHole: 0.1
    };

    var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
    chart.draw(data, options);
    var chart1 = new google.visualization.PieChart(document.getElementById('donutchart1'));
    chart1.draw(data1, options1);
    var chart2 = new google.visualization.PieChart(document.getElementById('donutchart2'));
    chart2.draw(data2, options2);




}

window.onresize = function(event) {
    drawChart();
};