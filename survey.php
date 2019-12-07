<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="veiwport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="CSS/survey_style.css"/>
    <title> PARC Survey </title>
  </head>
  <?php
	if (!include('connect.php')) {
	die('error finding connect file');
	}
	$dbh = ConnectDB();
    ?>
  <div id="container">
    <div id="header">
      <h1>Survey</h1>
    </div>
    <div id="content">
      <body>
	  <!-- method="get" shows values of variable in URL when subit button is pressed -->
	  <!-- change "get" to "post" in order to delete them from URL -->
	  <form action="/~kamichofa2/PARC/submit.php"  method="post" target="_self">
	    <h3>What time did you park today?</h3>
	    <div id="duration">
	      <input type="time" name="time_parked" min="06:00" max="21:00" step=900 required>
	      <br>
	      <br>
	      <br>
	    </div>
	    
	    <h3>How long did it take you to park?</h3>
	    <div id="time">
	      <input type="number" name="time_to_park" min="1" max="120" required> minutes (1-120)
	      <br>
	      <br>
	      <br>
	    </div>
	    
	    <h3>Which lot did you park in today?</h3>
	    <div id="lot">
	      <!-- radio button of lot parked in, button titled "nameParkedIn" -->
	    <?php
	      $sql = "SELECT * FROM kamichofa2.Lot_Names;";
	      $stmt = $dbh->prepare($sql);
	      $stmt->execute();
	    
	      foreach ($stmt->fetchAll() as $row) {
	        echo '<input type="radio" id="' . $row['parking_lot_id'] . '" name="id_lot_parked_in" ';
		echo 'value="' . $row['parking_lot_id'] . '" required>';
	        echo '<label for="' . $row['parking_lot_id'] . '">' . $row['name'] . '</label>';
	        echo '<br>';
	      }
	    ?>
	      <br>
	      <br>
	      <br>
	    </div>
	    
	    <h3>Approximatley how filled was that lot?</h3>
	    <div id="capacity" class="slidecontainer">
	      <input type="range" id="lot_utilization" name="lot_utilization" min="1" max="5" class="slider">
	    </div>
	      <br>
	      <br>
	      <br>
	    
	    <h3>Were you in an accident today?</h3>
	    <div id="accident">
	      <input type="radio" id="in_accident" name="accident_self" value="1">
	      <label for="in_accident">Yes</label>
	      <input type="radio" id="not_in_accident" name="accident_self" value="0" checked>
	      <label for="not_in_accident">No</label>
	      <br>
	      <br>
	      <br>
	    </div>
	    
	    <h3>Did you witness an accident today?</h3>
	    <div id="accident">
	      <input type="radio" id="witness" name="accident_witness" value="1">
	      <label for="witness">Yes</label>
	      <input type="radio" id="not_witness" name="accident_witness" value="0" checked>
	      <label for="not_witness">No</label>
	      <br>
	      <br>
	      <br>
	    </div>
	    
	    <h3>Did you park illegitimately today?</h3>
	    <div id="illegitimate_self">
	      <input type="radio" id="illegitimate_self" name="illegitimacy" value="1">
	      <label for="illegitimate_self">Yes</label>
	      <input type="radio" id="not_illegitimate_self" name="illegitimacy" value="0" checked>
	      <label for="not_illegitimate_self">No</label>
	      <br>
	      <br>
	      <br>
	    </div>

	    <h3>Did you witness someone parked illegitimately today?</h3>
	    <div id="illegitimate_witness">
	      <input type="radio" id="illegitimate_witness" name="illegitimacy_witness" value="1">
              <label for="illegitimate_witness">Yes</label>
              <input type="radio" id="not_illegitimate_witness" name="illegitimacy_witness" value="0" checked>
              <label for="not_illegitimate_witness">No</label>
              <br>
              <br>
	      <br>
	    </div>
	    
	    <h3>How satisfied are you with your parking experience today?</h3>
	    <div id="satisfaction" class="slidercontainer">
	      Very Dissatisfied <input type="range" id="experience" name="experience" min="1" max="5" class="slider"> Very Satisfied
	    </div>
	      <br>
	      <br>
	      <br>
	    
	    <br>
	    <br>
	    <input type="submit" value="submit">
	    <br>
	  </form>
      </body>
    </div>
  </div>
</html>
