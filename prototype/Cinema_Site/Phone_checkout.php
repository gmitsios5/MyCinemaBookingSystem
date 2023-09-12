<!-- PHONE CHECKOUT PAGE -->
<h1 style="color:#ffc107;">Current Tickets by Phone:</h1>
<?php
// MAKE NEW DATABASE CONNECTION
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cinema";
$conn = new mysqli($servername, $username, $password, $dbname);
$fname;
$lname;
$phone;
$last_id=[];
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error); }


// CHECK IF THERE IS A GET REQUEST FROM A FORM
  if ($_SERVER["REQUEST_METHOD"] == "GET"){
    // CHECK IF THERE ARE VALUES ON THE FIELDS AND IF THERE ARE THEN ALL THE DATA GET FILTERED
    if (isset($_GET['fname']) && isset($_GET['lname']) && isset($_GET['phone'])){
      if (strlen($_GET['fname'])>0 && strlen($_GET['lname'])>0 && strlen($_GET['phone'])>0){
        $fname = $_GET['fname'];
        $lname = $_GET['lname'];
        $phone = $_GET['phone'];

        $fname = test_input($_GET['fname']);
        $errorfield1 = "";
        $fname = filter_var($fname,FILTER_SANITIZE_STRING);

        $lname = test_input($_GET['lname']);
        $errorfield1 = "";
        $lname = filter_var($lname,FILTER_SANITIZE_STRING);

        $phone = test_input($_GET['phone']);
        $errorfield1 = "";
        $phone = filter_var($phone,FILTER_SANITIZE_NUMBER_INT);

        // CHECK IF THE USER HAS CHOSEN SEATS
        if (isset($_GET['seatarray'])){
          $seatname = $_GET['seatarray'];

// FOR EACH SELECTED SEAT MAKE A TICKET
          foreach ($seatname as $seats) {
// SQL STATEMENT FOR INSERTING NEW TICKET
            $sql16 = "insert into `ticket` (`projection_id`, `customer_id`, `Seat_Name`) values ('".$_SESSION['time_select']."','".$_SESSION["id"]."','".$seats."');";

            if ($conn->query($sql16) === TRUE) {

              $last_id[] = $conn->insert_id;
              // INSERT THE TICKETS IN PHONE TICKETS TABLE
              $sql22 = "insert into phone_tickets(First_name, Last_name, Phone_number, ticket_id) values('".$fname."','".$lname."','".$phone."','".$last_id[count($last_id)-1]."'); ";
              if ($conn->query($sql22) === FALSE){
                // ERROR MESSAGE
                ECHO "ERROR AT INSERTING PHONE TICKET";

              }

            }
          }
          $counter = 0;
          // FOREACH PHONE TICKET CURRENTLY INSERTED SHOW IT'S DATA (EMPLOYEE NAME, CUSTOMER NAME, CUSTOMER PHONE, MOVIE DATA, PROJECTION DATA, SEAT NAME, CINEMA NAME)
          foreach ($last_id as $kwdikos){
            $sql19 = "select users.First_Name, users.Last_Name, phone_tickets.First_name as custfname, phone_tickets.Last_name as custlname, phone_tickets.Phone_number as phone, Movie_title, Projection_Date, Projection_Time, ticket.Seat_Name as seatname, Name FROM ticket
            join projection on projection.Projection_id = ticket.projection_id
            join projection_time on projection.projection_time_id = projection_time.Projection_Time_id
            join cinema_overview on projection.cinema_id = cinema_overview.id
            join users on ticket.customer_id = users.id
            join movies on projection.movie_id = movies.Movie_id
            join phone_tickets on ticket.Ticket_id = phone_tickets.ticket_id
            where ticket.Ticket_id = ".$kwdikos."";

            $result19 = $conn->query($sql19);
            if ($result19->num_rows > 0) {


              while($row = $result19->fetch_assoc()) {
                $counter++;
                $cfname = $row['First_Name'];
                $clname = $row['Last_Name'];
                $custfname = $row['custfname'];
                $custlname = $row['custlname'];
                $phone = $row['phone'];
                $tmtitle = $row['Movie_title'];
                $tpdate = $row['Projection_Date'];
                $tptime = $row['Projection_Time'];
                $tseat = $row['seatname'];
                $tcinemahall = $row['Name'];

                echo "<table class='table' style='color:white;'>
                <thead>
                <tr>
                <th scope='col'>Employee's Full Name</th>
                <th scope='col'>Customer's Full Name</th>
                <th scope='col'>Customer's Phone Number</th>
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
                <td>".$custfname.' '.$custlname."</td>
                <td>".$phone."</td>
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

            else {     echo "SOMETHINGS WRONG WITH THE VISUALISATION"; }}$total = $counter*7;
            echo "<h1 style='color:white;'>TOTAL PRICE:</h1><h1 style='color:#ffc107;'> ".$total."$</h1>";

          }

          else {echo "";}
        }}
      }
      else {echo "";}
// CLOSE THE CONNECTION AFTER ALL
      $conn->close();

      ?>
