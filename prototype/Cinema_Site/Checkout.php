<!-- CHECKOUT PAGE -->

<?php
// CONNECT TO THE DATABASE WITH THE APPROPRIATE CREDENTIALS
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cinema";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error); }

// CHECK IF THERE IS A GET REQUEST
  if ($_SERVER["REQUEST_METHOD"] == "GET"){
echo "<h1 style='color:#ffc107;'>Your Tickets:</h1>";
// CHECK IF THE USER CHOOSE SEATS
    if (isset($_GET['seatarray'])){
      $seatname = $_GET['seatarray'];

      // FOR EACH SEAT THAT THE USER HAVE CHOSEN INSERT THEM INTO TICKET TABLE
      foreach ($seatname as $seats) {
        // SQL STATEMENT FOR INSERTING NEW TICKET
        $sql16 = "insert into `ticket` (`projection_id`, `customer_id`, `Seat_Name`) values ('".$_SESSION['time_select']."','".$_SESSION["id"]."','".$seats."');";
        if ($conn->query($sql16) === TRUE) {
        }
      }
      // COUNTER FOR COUNT THE  NUMBER OF TICKETS
      $counter=0;
    // SQL STATEMENT FOR SHOWING THE CURRENT USER'S TICKETS DATA IN A TABLE
      $sql19 = "select First_Name, Last_Name, Movie_title, Projection_Date, Projection_Time, ticket.Seat_Name as seatname, Name FROM ticket
      join projection on projection.Projection_id = ticket.projection_id
      join projection_time on projection.projection_time_id = projection_time.Projection_Time_id
      join cinema_overview on projection.cinema_id = cinema_overview.id
      join users on ticket.customer_id = users.id
      join movies on projection.movie_id = movies.Movie_id
      where users.id =".$_SESSION["id"]." and Check_time = CURRENT_TIMESTAMP";
      $result19 = $conn->query($sql19);
      if ($result19->num_rows > 0) {
        while($row = $result19->fetch_assoc()) {
          $counter++;
          $cfname = $row['First_Name'];
          $clname = $row['Last_Name'];
          $tmtitle = $row['Movie_title'];
          $tpdate = $row['Projection_Date'];
          $tptime = $row['Projection_Time'];
          $tseat = $row['seatname'];
          $tcinemahall = $row['Name'];
        echo "<table class='table' style='color:white;'>
  <thead>
    <tr>
      <th scope='col'>Customer's Full Name</th>
      <th scope='col'>Movie Title</th>
      <th scope='col'>Projection Date</th>
      <th scope='col'>Projection Time</th>
      <th scope='col'>Seat</th>
      <th scope='col'>Cinema Hall</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>".$cfname.' '.$clname."</td>
      <td>".$tmtitle."</td>
      <td>".$tpdate."</td>
      <td>".$tptime."</td>
      <td>".$tseat."</td>
      <td>".$tcinemahall."</td>
    </tr>
  </tbody>
</table><br><br>";
        }
        // TOTAL PRICE
          $total = 7*$counter;
        echo "<h1 style='color:white;'>TOTAL PRICE:</h1><h1 style='color:#ffc107;'> ".$total."$</h1>";
        // ERROR MESSAGE
      } else {     echo "SOMETHINGS WRONG WITH THE VISUALISATION"; }

    }else {echo "";}

  }
  else {echo "";}
// CLOSE THE CONNECTION WITH THE DATABASE AFTER ALL
  $conn->close();

  ?>
