<!-- SEAT RESERVATION PAGE -->


<?php
// CHECK IF THERE IS A POST REQUEST
if ($_SERVER["REQUEST_METHOD"] == "POST"){
  $prid = $_POST['Time_select'];
  // CHHECK IF THE GO TO SEATS BUTTON IS PRESSED
  if(isset($_POST['gotoseats'])){
    // CHECK IF THE USER HAS CHOSEN A PROJECTION AND SHOW THE CINEMA LAYOUT WITH THE SEATS
    if(isset($_POST['Proj_date_selector'])){
      $proj_date = $_POST['Proj_date_selector'];
      echo "<section id='seat_reservation' style=''>";
      echo "<h1 style='color:#ffc107; text-align:center;'>SEAT RESERVATION</h1> <br>";
      echo "<p style='color:#ffc107; text-align:center;'>Projection Date: ".$proj_date."</p><br>";

      if (isset($_POST['Time_select'])){

        // MAKE NEW CONNECTION WITH DATABASE
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "cinema";
        $conn = new mysqli($servername, $username, $password, $dbname);
        $proj_time;
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error); }
// SQL STATEMENT FOR SHOWING THE SELECTED PROJECTION'S DATA
          $sql21 = "select projection_time.Projection_Time  from projection_time
          join projection on projection_time.Projection_Time_id = projection.projection_time_id
          where projection_id =".$prid;
          $result21 = $conn->query($sql21);
          if ($result21->num_rows > 0) {

            while($row = $result21->fetch_assoc()) {
              $proj_time = $row['Projection_Time'];
              echo "<p style='color:#ffc107; text-align:center;'>Projection Time: ".$proj_time."</p><br>";
            }
          }


          if(isset($_POST['projid'])){
            $_SESSION['time_select'] = $prid;

            $_SESSION['cinema_id'] = $_POST['cinema_id'];

          }else {echo "<br>something is wrong with projid";}

        }else{echo "NO PROJECTION date selected";}

      }else{ echo "NO PROJECTION SELECTED";}


      $taken_seats = [];
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error); }
// SQL STATEMENT FOR SHOWING ALL THE RESERVED SEATS
        $sql20 = "select Seat_Name FROM `ticket` where projection_id =".$prid;

        $result20 = $conn->query($sql20);
        $cinema_code = $_POST['cinema_id'];
        if ($result20->num_rows > 0) {

          $countseats = 0;
          while($row = $result20->fetch_assoc()) {
            $taken_seats[$countseats] = $row['Seat_Name'];
            $countseats++;
          }

        }
        echo "<form id='seatselectfotm' method='get' action='index.php#".$_SESSION["phone_checkout_redirect"]."' style='text-align:center;'>
        <div  style='".$_SESSION["phonebook"]." width:20%; margin-left:auto; margin-right:auto;'>
        <input type='text' class='form-control'  placeholder='First Name' name='fname' value='' ><br>
        <input type='text' class='form-control'  placeholder='Last Name' name='lname' value=''><br>
        <input type='text' class='form-control'  placeholder='Phone number' name='phone' value=''><br>
        </div>";


    // SHOW THE CINEMA LAYOUT OF THE SELECTED PROJECTION
        $sqlss = "select * FROM Cinema_Overview where id='".$cinema_code."'";
        $resultss = $conn->query($sqlss);

        if ($resultss->num_rows > 0) {

          while($row = $resultss->fetch_assoc()) {
            $cin_name = $row["Name"];
            echo "<p style='color:#ffc107; text-align:center;'>Cinema: ".$cin_name."</p>";

            echo "<table align='center' border='2' cellpadding='5' cellspacing='10' style=''>";
            for($i=1;$i<=$row["rows"];$i++)
            {
              echo "<tr>";
              for ($j=1;$j<=$row["cols"];$j++)
              {
                $sname = chr(64 + $i).".".$j;
// FOR EACH RESERVED SEAT DISABLE AND TURN IT RED
                if(in_array(chr(64 + $i).".".$j,$taken_seats, true)){
                  echo "<td  style='background-color:red; color=white; padding:10px;'>".$sname."</td>";
                }
                // ELSE BRING ALL THE SEATS THAT THEY ARE NOT RESERVED
                else{  echo "<td style='"."background-color:#ffc107; color='black';"."'><input type='checkbox' value='".$sname."' class="."btn-primary"." id='".$sname."' name ='seatarray[]' style="."'width:100%; color:green;'".">".$sname."</input></td>";
                }

              }
              echo "</tr>";
            }

          }    echo "</table>
          <hr style='border: 1px solid red !important;display:block; width:50%;'><p style='text-align:center; font-size:20px; color:#ffc107;'>Screen</p>
          <input  type='submit' class='btn btn-warning' id='submit_seat' name='submit_seat' value='Select Seats'>
          </form>";

        }
        else {    echo "<h1>Nothing to show!!</h1>"; }

      }

      else {echo "<h1>Nothing to show!!</h1>";}
      echo "<div style='".$phonebook."'>";

      // SQL STATEMENT FOR SHOWING ALL THE ONLINE ALREADY BOOKED TICKETS
      $sql30 = "select distinct users.First_Name, users.Last_Name, Movie_title, Projection_Date, Projection_Time, ticket.Seat_Name as seatname, Name FROM ticket
      join projection on projection.Projection_id = ticket.projection_id
      join projection_time on projection.projection_time_id = projection_time.Projection_Time_id
      join cinema_overview on projection.cinema_id = cinema_overview.id
      join users on ticket.customer_id = users.id
      join movies on projection.movie_id = movies.Movie_id
      WHERE ticket.Ticket_id not in
      (select ticket.Ticket_id FROM ticket
      join projection on projection.Projection_id = ticket.projection_id
      join projection_time on projection.projection_time_id = projection_time.Projection_Time_id
      join cinema_overview on projection.cinema_id = cinema_overview.id
      join users on ticket.customer_id = users.id
      join movies on projection.movie_id = movies.Movie_id
      join phone_tickets on ticket.Ticket_id = phone_tickets.ticket_id)
      and projection.Projection_id =".$prid;
      $result30 = $conn->query($sql30);
      if ($result30->num_rows > 0) {
        echo "<h1 style='color: #ffc107;'>Already booked(ONLINE):</h1>";

        while($row = $result30->fetch_assoc()){
          $cfname2 = $row['First_Name'];
          $clname2 = $row['Last_Name'];
          $tmtitle2 = $row['Movie_title'];
          $tpdate2 = $row['Projection_Date'];
          $tptime2 = $row['Projection_Time'];
          $tseat2 = $row['seatname'];
          $tcinemahall2 = $row['Name'];
          echo "

          <table class='table' style='color:white;'>
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
          <td>".$cfname2.' '.$clname2."</td>
          <td>".$tmtitle2."</td>
          <td>".$tpdate2."</td>
          <td>".$tptime2."</td>
          <td>".$tseat2."</td>
          <td>".$tcinemahall2."</td>
          </tr>
          </tbody>
          </table><br><br>
          ";
        }
        echo "</div>";
      }


    }  else {}

      echo "<div style='".$phonebook."'>";
      // SQL STATEMENT FOR SHOWING ALL THE RESERVED TICKETS BY PHONE
      $sql30 = "select distinct users.First_Name, users.Last_Name, phone_tickets.First_name as custfname, phone_tickets.Last_name as custlname, phone_tickets.Phone_number as phone, Movie_title, Projection_Date, Projection_Time, ticket.Seat_Name as seatname, Name FROM ticket
      join projection on projection.Projection_id = ticket.projection_id
      join projection_time on projection.projection_time_id = projection_time.Projection_Time_id
      join cinema_overview on projection.cinema_id = cinema_overview.id
      join users on ticket.customer_id = users.id
      join movies on projection.movie_id = movies.Movie_id
      join phone_tickets on ticket.Ticket_id = phone_tickets.ticket_id
      where projection.Projection_id =".$prid;
      $result30 = $conn->query($sql30);
      if ($result30->num_rows > 0) {
        echo "<h1 style='color: #ffc107;'>Already booked(BY PHONE):</h1>";

        while($row = $result30->fetch_assoc()){
          $cfname2 = $row['First_Name'];
          $clname2 = $row['Last_Name'];
          $custfname = $row['custfname'];
          $custlname = $row['custlname'];
          $tmtitle2 = $row['Movie_title'];
          $tpdate2 = $row['Projection_Date'];
          $tptime2 = $row['Projection_Time'];
          $tseat2 = $row['seatname'];
          $tcinemahall2 = $row['Name'];
          echo "

          <table class='table' style='color:white;'>
          <thead>
          <tr>
          <th scope='col'>Employee's Full Name</th>
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
          <td>".$cfname2.' '.$clname2."</td>
          <td>".$custfname.' '.$custlname."</td>
          <td>".$tmtitle2."</td>
          <td>".$tpdate2."</td>
          <td>".$tptime2."</td>
          <td>".$tseat2."</td>
          <td>".$tcinemahall2."</td>
          </tr>
          </tbody>
          </table><br><br>
          ";
        }
        echo "</div>";
      }
// CLOSE CONNECTION
      $conn->close();



      ?>
    </section>
