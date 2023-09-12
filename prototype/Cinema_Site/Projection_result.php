<!-- ADD NEW PROJECTION RESULT PAGE -->

<?php

// MAKE NEW DATABASE CONNECTION
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cinema";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// CHECH IF THERE IS A POST REQUEST
if ($_SERVER["REQUEST_METHOD"] == "POST"){
// IF THE FIELDS ARE FILLED CORRECT THEN FILTER THE DATA
  if (isset($_POST["Movie_choice"]) && !empty(isset($_POST["Movie_choice"]))){
    $movie_choice_proj =$_POST["Movie_choice"];
    $errorfield1 = "";

  }
  else {
    $errorfield1 = "error_red_borders";
  }


  if (isset($_POST["ptime_choice"]) && !empty(isset($_POST["ptime_choice"]))){

    $ptime_choice_proj =$_POST["ptime_choice"];
    $errorfield1 = "";

  }
  else {
    $errorfield1 = "error_red_borders";
  }


  if (isset($_POST["Hall_choice"]) && !empty(isset($_POST["Hall_choice"]))){
    $hall_select_proj = $_POST["Hall_choice"];

    $errorfield1 = "";

  }
  else {

    $errorfield1 = "error_red_borders";
  }
// SQL STATEMENT FOR INSERTING NEW PROJECTION TO MOVIE
  $sql_insert_proj = "insert into `projection` (projection_time_id, cinema_id, movie_id)
  VALUES
  ('".$ptime_choice_proj."','".$hall_select_proj."','".$movie_choice_proj."')";
  $result = $conn->query($sql_insert_proj);
  if ($result === TRUE) {
    // SUCCESS MESSAGE
    echo "<script type='text/javascript'>
    alert('Projection added succesfully!!');
    location='index.php#add_projection_section';
    </script>";
  }

  else{
    // ERROR MESSAGES
    echo "Error: " . $sqlin . "<br>" . $conn->error;
  }
  // CLOSE CONNECTION AFTER ALL
  $conn->close();

}
?>
