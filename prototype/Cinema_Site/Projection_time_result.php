<!-- ADD PROJECTION DATE AND TIME RESULT -->

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
// CHECK IF THERE IS A POST REQUEST
if ($_SERVER["REQUEST_METHOD"] == "POST"){

// CHECK IF THE VALUES ARE PROPERLY FILLED AND FILTER THE DATA
  if (isset($_POST["year_picker"]) && !empty(isset($_POST["year_picker"]))){
    $date_picker_proj = $_POST["year_picker"];

    $errorfield1 = "";

  }
  else {

    $errorfield1 = "error_red_borders";
  }

  if (isset($_POST["select_time"]) && !empty(isset($_POST["select_time"]))){
    $time_select_proj = $_POST["select_time"];
    $errorfield1 = "";
    $time_select_proj = filter_var($time_select_proj,FILTER_SANITIZE_STRING);
  }
  else {

    $errorfield1 = "error_red_borders";
  }
// SQL STATEMENT FOR ISNERTING NEW PROJECTION DATE AND TIME
  $sql_insert_proj_time = "insert into `projection_time` (Projection_Date,Projection_Time)
  VALUES
  ('".$date_picker_proj."','".$time_select_proj."')";
  $result = $conn->query($sql_insert_proj_time);
  if ($result === TRUE) {

    // SUCCESS MESSAGE
    echo "<script type='text/javascript'>
    alert('Projection Date & Time added succesfully!!');
    location='index.php#add_projection_time_section';
    </script>";
  }

  else{
    // ERROR MESSAGE
    echo "Error: " . $sqlin . "<br>" . $conn->error;
  }
// CLOSE CONNECTION AFTER ALL
  $conn->close();

}

?>
