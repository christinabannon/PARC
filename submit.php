<!DOCTYPE html>
<html>
  <head>
    <title> Survey Complete </title>
  </head>
  <div>
    <meta charset = "UTF-8">
    <meta name="veiwport" content="width=device-width, initial-scale=1">

    <?php
      if (!include('connect.php')) {
      die('error finding connect file');
      }
      $dbh = ConnectDB();
    ?>

    <body>
      <?php
         if (count($_POST) < 9) {
           echo "Something went wrong. Please try again.";
         }
         else {

           $time_parked = $_POST["time_parked"] . ":00";
           $time_to_park = $_POST["time_to_park"];
           $experience = $_POST["experience"];

           $sql = "SELECT kamichofa2.add_session(:timeparked, :timetopark, :satisfact) as session_id;";
           $stmt = $dbh->prepare($sql);
           $stmt->bindParam(':timeparked', $time_parked, PDO::PARAM_STR, 8);
           $stmt->bindParam(':timetopark', $time_to_park, PDO::PARAM_INT);
           $stmt->bindParam(':satisfact', $experience, PDO::PARAM_INT);
           $stmt->execute();
           $info = $stmt->fetch();
           $session_id = $info['session_id'];

           $lot_id = $_POST["id_lot_parked_in"];
           $parked_illegal = $_POST["illegitimacy"];
           $saw_parked_illegal = $_POST["illegitimacy_witness"];
           $accident = $_POST["accident_self"];
           $saw_accident = $_POST["accident_witness"];
           $lot_utilization = $_POST["lot_utilization"];

           $sql = "SELECT kamichofa2.add_lot_visit(" . $session_id . ", :lot_id, 1, :illegit_parking, ";
           $sql .= ":saw_illegit_parking, :accident, :saw_accident, :lot_utilization) as lot_visit_id;";
           $stmt = $dbh->prepare($sql);
           $stmt->bindParam(':lot_id', $lot_id, PDO::PARAM_INT);
           $stmt->bindParam(':illegit_parking', $parked_illegal, PDO::PARAM_INT);
           $stmt->bindParam(':saw_illegit_parking', $saw_parked_illegal, PDO::PARAM_INT);
           $stmt->bindParam(':accident', $accident, PDO::PARAM_INT);
           $stmt->bindParam(':saw_accident', $saw_accident, PDO::PARAM_INT);
           $stmt->bindParam(':lot_utilization', $lot_utilization, PDO::PARAM_INT);
           $stmt->execute();
           $info = $stmt->fetch();

           if ($info['lot_visit_id'] != "") {
             echo "cool";
           }
      
         }
       ?>
    </body>
    <div class="imgbox">
                                        <a href="http://elvis.rowan.edu/~kamichofa2/PARC/data.php">
                                                <img class="center-fit"  src="pics/DATA.png">
                                        </a>
                                </div>
  </div>
</html>
