<!-- ADD PROJECTION TO MOVIE FORM -->


<section id="add_projection_section" style=" box-shadow: 0 0 15px 10px #000000" style="display:<?php ?>;">
  <h2 style="text-align:center; color:#ffc107; padding-top:25px;">ADD PROJECTION</h2>
  <div class="container">
    <div class="row">
      <div class="col">
        <form method="POST" action="Projection_result.php">
          <div class="form-group">
            <?php
            // CONNECTION TO THE DATABASE WITH THE APPROPRIATE CREDENTIALS
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "cinema";
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }
            // SQL STATEMENT FOR SHOWING A SELECT OPTION TAG TO SELECT MOVIE
            $sql23="select  Movie_id,Movie_title FROM movies";
            $result23 = $conn->query($sql23);
            if ($result23->num_rows > 0) {
              echo "
              <label id=add_movie_label for=Movie Title >Choose Movie:</label>";
              echo "<select class='form-control' name='Movie_choice' id='Choose_movie_proj'>";
              while($row = $result23->fetch_assoc()) {
                $movie_id_proj = $row['Movie_id'];
                $movie_title_proj = $row['Movie_title'];
                echo "<option value='".$movie_id_proj."'>".$movie_title_proj."</option>";
              }
              echo  " </select>";
            }
            // ERROR MESSAGE
            else {echo "No movies found";}
            ?>
          </div>
          <div class="form-group">
            <?php

            // CONNECTION TO THE DATABASE WITH THE APPROPRIATE CREDENTIALS

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "cinema";
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }

            // SQL STATEMENT FOR SHOWING ALL DATA FROM PROJECTION_TIME TABLE IN A SELECT OPTION TAG
            $sql25 ="select * FROM `projection_time`";
            $result25 = $conn->query($sql25);
            if ($result25->num_rows > 0) {

              echo "<label id='edit_cinema_hall_label' for='Schedule'>Choose Schedule Time:</label>";
              echo "<select class='form-control' name='ptime_choice' id='ptime_choice' style='width:30%;'>";
              while($row = $result25->fetch_assoc()) {
                $ptime_id = $row['Projection_Time_id'];
                $pdate = $row['Projection_Date'];
                $ptime = $row['Projection_Time'];
                echo "<option value='".$ptime_id."'><strong>Date:<strong> ".$pdate." -- Time: ".$ptime."</option>";
              }
              echo  " </select>";
            }
            else {echo "No dates found";}
            ?>
          </div>
          <div class="form-group">

            <?php
            // CONNECTION TO THE DATABASE WITH THE APPROPRIATE CREDENTIALS
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "cinema";
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }
            // GET THE HALL OWNER ID WITH SESSION GLOBAL VARIABLE
            $hall_own_id = $_SESSION['id'];

            // SQL STATEMENT FOR SHOWING CINEMA'S ID, NAME OF THE CURRENT OWNER IN A SELECT OPTION TAG FOR THE OWNER TO CHOOSE
            $sql24 ="select id, Name FROM `cinema_overview` WHERE owner_id = '".$hall_own_id."'";
            $result24 = $conn->query($sql24);
            if ($result24->num_rows > 0) {

              echo "<label id='edit_cinema_hall_label' for='Hall Title'>Choose Hall:</label>";
              echo "<select class='form-control' name='Hall_choice' id='Choose_Hall_to_edit' style='width:20%;'>";
              while($row = $result24->fetch_assoc()) {
                $hall_id = $row['id'];
                $hall_title = $row['Name'];
                echo "<option value='".$hall_id."'>".$hall_title."</option>";
              }
              echo  " </select>";
            }
            else {echo "No halls found";}
            ?>
          </div>
          <div class="form-group">
            <input  type="submit"  class="form-control" style="background-color:#ffc107;; color:#000000; margin-left: auto; margin-right: auto; width:25%;" value="Make Projection" style="">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</section>
