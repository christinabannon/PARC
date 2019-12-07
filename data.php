<!DOCTYPE html>
<html>
<?php                                                                                                                                                                                                  
        if (!include('connect.php')) {                                                                                                                                                                 
        die('error finding connect file');                                                                                                                                                             
        }                                                                                                                                                                                              
        $dbh = ConnectDB();                                                                                                                                                                            
?>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" 
		content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel=stylesheet href="CSS/style.css"/>
        <title> PARC </title>

	<!-- bootstrap css -->
	<link rel="stylesheet" 
		href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
		integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 	   
		crossorigin="anonymous">

    <!-- google api for the line thing -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

    <?php
      $sql = "SELECT * FROM kamichofa2.Average_Time_Per_Hour;";
      $stmt = $dbh->prepare($sql);
      $stmt->execute();

      echo 'function drawChart() {';
      echo "\n";
      echo 'var data = google.visualization.arrayToDataTable([';
      echo "\n";
      echo "['Time of Day', 'Time to Park'],";
      echo "\n";
      
      foreach ($stmt->fetchAll() as $row) {
	  echo "['" . $row['hour'] . "', " . $row['avg_time'] . "]";
	  if($row['hour'] != "9:00 PM") {
	      echo ', ';
	  }
	  echo "\n";
      }

      echo ']);';
      echo "\n";
      ?>

        var options = {
          title: 'Parking at Rowan',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
</head>
<body>
    <div class="container">

	Google line chart: 
    	<div id="curve_chart" style="width: 100vw; height: 500px;"></div>
	<br>
    	<form action="/~kamichofa2/PARC/index.html" method="post">
               <input type="submit" value="GO HOME">
    	</form>
    </div>

    <!-- bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>


