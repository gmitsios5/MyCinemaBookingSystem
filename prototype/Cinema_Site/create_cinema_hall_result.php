<?php
// START A SESION FOR TRANSPORT VALUES WITHIN THE PAGES
session_start();
// CONNECTION WITH DATABASE WITH THE APPROPRIATE CREDENTIALS
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cinema";
$c_rows;
$c_cols ;
$c_name;
$owner_id = $_SESSION["id"];
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// FUNCTION WHICH FILTERS THE DATA
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// CHECH IF THERE IS A REQUEST FROM A POST FORM

if ($_SERVER["REQUEST_METHOD"] == "POST"){

  if (isset($_POST["create_cinema_hall_btn"])){
// CHECK IF THE INPUT VALUES ARE EMPTY AND THEN FILTER THE DATA
    if (isset($_POST["Cinema_title"]) && !empty(isset($_POST["Cinema_title"]))){
      $c_name = $_POST["Cinema_title"];
      $c_name = test_input($c_name);
      $errorfield1 = "";
      $c_name = filter_var($c_name,FILTER_SANITIZE_STRING);
    }
    else {

      $errorfield1 = "error_red_borders";
    }
    if (isset($_POST["Cinema_rows"]) && !empty(isset($_POST["Cinema_rows"]))){
      $c_rows = $_POST["Cinema_rows"];
      $c_rows = test_input($c_rows);
      $errorfield1 = "";
      $c_rows = filter_var($c_rows,FILTER_SANITIZE_NUMBER_INT);
    }
    else {

      $errorfield1 = "error_red_borders";
    }

    if (isset($_POST["Cinema_cols"]) && !empty(isset($_POST["Cinema_cols"]))){
      $c_cols = $_POST["Cinema_cols"];
      $c_cols = test_input($c_cols);
      $errorfield1 = "";
      $c_cols = filter_var($c_cols,FILTER_SANITIZE_NUMBER_INT);
    }
    else {

      $errorfield1 = "error_red_borders";
    }
  }
}


// SQL STATEMTN FOR INSERTING DATA INTO CINEMAS TABLE
$sql_create_cinema_hall = "insert into cinema_overview (`rows`, `cols`, `Name`, `Owner_id`)
VALUES
(".$c_rows.",".$c_cols.",'".$c_name."',".$owner_id.")";
$result = $conn->query($sql_create_cinema_hall);
// MESSAGE FOR SUCCESSFUL INSERTING
if ($result === TRUE) {
  echo "<script type='text/javascript'>
  alert('Hall created succesfully!!');
  location='index.php';
  </script>";
}
else{
  // ERROR MESSAGE
  echo "<script type='text/javascript'>
  alert('Unsuccesful creation. Try again!!');
  location='index.php';
  </script>";
}
// AFTER ALL CLOSE THE CONNTECTION WITH THE DATABASE
$conn->close();

?>
