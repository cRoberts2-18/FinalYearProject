<html>
<style type="text/css">

div.chart{
        text-align: center;
        margin-left: auto;
        margin-right: auto;
        width: 800px;
}



</style>
<head>
<?php
$con = mysqli_connect('localhost','phpmyadmin','123123','Weather');
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = google.visualization.arrayToDataTable([
        ['Date','Temperature'],
        <?php
                $date = date('Y-m-d');
                $query = "SELECT `Date`, `Temperature` FROM Readings WHERE `Date` Like \"".$date."%\"";
                $exec = mysqli_query($con,$query);
                while($row = mysqli_fetch_array($exec)){
                         echo "['".$row['Date']."',".$row['Temperature']."],";
                 }
        ?>
        ]);

        // Set chart options
        var options = {'title':'Todays Hourly Averages',
                       'width':700,
                       'height':500
                        };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);

        var data1 = google.visualization.arrayToDataTable([
        ['Date','Max Temp'],
        <?php
                $year = date('Y');
                $month = date('m');
                $query = "SELECT `Date`, `Max Temp` FROM Readings WHERE `Date` LIKE  \"".$year."-".$month."%\"";
                $exec = mysqli_query($con,$query);
                while($row = mysqli_fetch_array($exec)){
                         echo "['".$row['Date']."',".$row['Max Temp']."],";
                 }
        ?>
        ]);

        // Set chart options
        var options1 = {'title':'Monthly Highs',
                       'width':700,
                       'height':500
                        };

        // Instantiate and draw our chart, passing in some options.
        var chart1 = new google.visualization.LineChart(document.getElementById('chart_div1'));
        chart1.draw(data1, options1);

        var data2 = google.visualization.arrayToDataTable([
        ['Date','Min Temp'],
        <?php
                $year = date('Y');
                $month = date('m');
                $query = "SELECT `Date`, `Min Temp` FROM Readings WHERE `Date` LIKE \"".$year."-".$month."%\"";
                $exec = mysqli_query($con,$query);
                while($row = mysqli_fetch_array($exec)){
                         echo "['".$row['Date']."',".$row['Min Temp']."],";
                 }
				         ?>
        ]);

        // Set chart options
        var options2 = {'title':'Monthly Lows',
                       'width':700,
                       'height':500
                        };

        // Instantiate and draw our chart, passing in some options.
        var chart2 = new google.visualization.LineChart(document.getElementById('chart_div2'));
        chart2.draw(data2, options2);
      }
    </script>
</head>

<body>
<div id="chart_div" class="chart"></div>
<div id="chart_div1" class="chart"></div>
<div id="chart_div2" class="chart"></div>
</body>

