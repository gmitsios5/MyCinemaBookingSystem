<!-- PAGE OF MOVIE SELECTION -->

<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link href="css/movie_cards.css" rel="stylesheet">
</head>
<body style="background-color:black;">
  <h2 style="color:#ffc107; text-align:center;!important display:inline;">Choose a Movie:</h2>
  <div class="container" style="margin-top:200px;display:inline;">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <div class='carousel-inner'>


        <?php
        // MAKE NEW CONNECTION WITH DATABASE
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "cinema";



        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
        // SQL STATEMENT FOR SHOWING ALL THE MOVIES WITH EACH DATA AT A CAROUSEL IN CARDS FORM
        $sql1 ="select  movies.Movie_id, Movie_title, Movie_description, Movie_release_year, Movie_duration, Movie_trailer, Movie_image, Movie_gendre FROM movies";


        // SWITCH ACTIVE OR INACTIVE CLASS IN ORDER TO SHOW THE MOVIES PROPERLY
        $active1="item active";
        $inactive="item";
        $active2 =$active1;
        $result = $conn->query($sql1);

        if ($result->num_rows > 0) {

          while($row = $result->fetch_assoc()) {

            $active2 == $active1 ? $active1 = $inactive : $active2 = $active1;

            $mid=$row['Movie_id'];
            $mtitle=$row['Movie_title'];
            $mry=$row['Movie_release_year'];
            $mg=$row['Movie_gendre'];
            $md=$row['Movie_duration'];
            $mdesc=$row['Movie_description'];
            $mimage=$row['Movie_image'];
            $mtrailer=$row['Movie_trailer'];



            echo "<div class='".$active2."'>
            <div class='wrapper'>
            <div class='main_card'>
            <div class='card_left'>
            <div class='card_datails'>
            <h1>".$mtitle."</h1>
            <div class='card_cat'>
            <p class='year'>".$mry."</p>
            <p class='genre'>".$mg."</p>
            <p class='time'>".$md."</p>
            </div>
            <p class='disc'>".$mdesc."</p>

            <div class='social-btn'>
            <!-- WATCH TRAILER-->
            <a href='#trailer".$mid."' data-toggle='modal' style='display:inline;'><button class='btn_cards'>
            SEE TRAILER
            </button></a>
            <!-- GET-->
            <a href='#booking".$mid."' data-toggle='modal' style='display:inline;'><button class='btn_cards'>
            BOOKING
            </button></a>
            <!--USERS RATINGS-->

            <!--BOOKMARK-->
            </div>
            </div>
            </div>
            <div class='card_right'>
            <div class='img_container'>
            <img src=".$mimage.">
            </div>
            </div>
            </div>
            </div>
            </div>

            // TRAILER MODAL

            <div class='modal fade' id='trailer".$mid."' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered' role='document'>
            <div class='modal-content'>
            <div class='modal-header'>
            <h5 class='modal-title' id='exampleModalLongTitle'>".$mtitle."</h5>
            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
            </div>
            <div class='modal-body'>
            <iframe width='570' height='345' src='https://www.youtube.com/embed/".$mtrailer."' allowfullscreen>
              </iframe>
              </div>
              <div class='modal-footer'>
              </div>
              </div>
              </div>
              </div>


              <div class='modal fade' id='booking".$mid."' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true' style='font-size:20px;'>
              <div class='modal-dialog modal-dialog-centered modal-sm' role='document'>
              <div class='modal-content'>
              <div class='modal-header'>
              <h5 class='modal-title' id='exampleModalLongTitle'>Booking for ".$mtitle."</h5>
              <button type='button' class='close' data-dismiss='modal' aria-label='Close'>

              <span aria-hidden='true'>&times;</span>
              </button>
              </div>
              <div class='modal-body'>
              // SELECT PROJECTION FORM
              <form id='projform".$mid."' method='post' action='index.php#seat_reservation'>
              Available Dates:<br>

              ";

              // SQL STATEMENT FOR SHOWING THE PROJECTIONS OF ALL THE MOVIES SEPARATELY IN A SELECTION FORM
              $sql2="select Movie_id, Projection.Projection_id as projid, projection_time.Projection_Date, projection.cinema_id FROM projection
              Join projection_time on projection.projection_time_id = projection_time.Projection_Time_id
              join cinema_overview on projection.cinema_id = cinema_overview.id
              WHERE Movie_id = ".$mid."
              group by projection_time.Projection_Date
              order by projection_time.Projection_Date asc";



              $result2 = $conn->query($sql2);

              if ($result2->num_rows > 0) {

                echo "<select name='Proj_date_selector' id='Bookingdate".$mid."' onchange='Projection_dates(".$mid.")'>
                <option selected disabled>Select a date</option>
                ";

                while($row = $result2->fetch_assoc()){
                  $pid = $row['projid'];
                  $pdate= $row['Projection_Date'];
                  $cid = $row['cinema_id'];
                  echo "<option value='".$pdate."'>".$pdate."</option>";

                }

                echo "</select>";

                echo "<div id='option_time".$mid."'></div>
                <input type='hidden' id='cinema_id' name='cinema_id' value='".$cid."'></input>
                <input type='hidden' id='projid' name='projid' value='".$pid."'></input>

                ";
              } else {echo "NO Projections";}



              ?>


              <?php
              echo "
              </div>
              <div class='modal-footer'>
              <input form = 'projform".$mid."' type='submit' name='gotoseats' value='Continue to the seats'></input>

              </div>
              </form>
              </div>
              </div>
              </div>


              ";


            }}
            // ERROR MESSAGE
            else {     echo "MOVIE CONTENT NOT FOUND"; } $conn->close();


            ?>




          </div>
          <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
      <div>



      </div>
      <!-- FUNCTION WHICH SHOWS THE PROJECTION TIME DEPENDS ON PROJECTION DATE CHOICE USING JAVASCRIPT AND AJAX CALLS  -->
      <script>
      function Projection_dates(pdate){
        if(document.getElementById("Bookingdate"+pdate)){
          var date = new Date(document.getElementById("Bookingdate"+pdate).value);

          console.log(date);
          var dateready = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
          console.log(dateready);
          var mydate = "{\"date\":\""+dateready+"\",\"mid\":\""+pdate+"\"}";

          jQuery.ajax({
            url:"dates.php",
            type:"POST",
            data:mydate,
            dataType:"json",
            success:function(result)
            {
              var option_time_div = document.getElementById("option_time"+pdate);
              console.log('lalala');
              option_time_div.innerHTML = "";
              var select_html = "<select name='Time_select' id='Time_select'>";
              for(i=0;i<result.length;i++){
                select_html += "<option value='"+result[i]['Projection_id']+"' >"+result[i]['Projection_Time']+"</option>";

              }
              select_html += "</select>";
              option_time_div.innerHTML = select_html;
            },
            error: function(){
              var option_time_div = document.getElementById("option_time").innerHTML= "<p>No projection found</p>";
            }
          });

        }} </script>


      </body>
      </html>
