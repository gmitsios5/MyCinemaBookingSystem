<!-- USER'S TICKET HISTORY PAGE -->


<?php
// MAKE A NEW DATABASE CONNECTION
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cinema";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error); }

// IF THERE IS A REQUEST FROM POST FORM
if ($_SERVER["REQUEST_METHOD"] == "POST"){
// IF THE BUTTON OF THE TICKET'S HISTORY IS PRESSED THEN SHOW THE TICKETS
  if (isset($_POST["mytickets"])){
echo "<h1 style='color:#ffc107;'>My tickets:</h1>";
// SQL SATTEMENT FOR SHOWING ALL THE TICKETS OF THE CURRENT USER IN TABLES
    $sql19 = "select First_Name, Last_Name, Movie_title, Projection_Date, Projection_Time, ticket.Seat_Name as seatname, Name FROM ticket
    join projection on projection.Projection_id = ticket.projection_id
    join projection_time on projection.projection_time_id = projection_time.Projection_Time_id
    join cinema_overview on projection.cinema_id = cinema_overview.id
    join users on ticket.customer_id = users.id
    join movies on projection.movie_id = movies.Movie_id
    where users.id =".$_SESSION["id"]."";
    $result19 = $conn->query($sql19);
    if ($result19->num_rows > 0) {
      while($row = $result19->fetch_assoc()) {
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
    }
// ERROR MESSAGE
    else {echo "NO ROWS";}

  }}else {}
    // CLOSE THE CONNECTION
$conn->close();

?>
