<!-- EDIT CINEMA RESULT PAGE -->

<?php

// CONNECTION WITH DATABASE WITH THE APPROPRIATE CREDENTIALS
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cinema";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$hid = $_POST['hid'];

// FUNCTION FOR FILTERING THE DATA
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
// CHECH IF THERE IS A REQUEST FROM A POST FORM
if ($_SERVER["REQUEST_METHOD"] == "POST"){
// CHECK IF THE FIELDS ARE FILLED AND THEN FILTER THEM
  if (isset($_POST['Cinema_title']) && !empty(isset($_POST['Cinema_title']))){
    $ctitle = $_POST['Cinema_title'];

    $errorfield1 = "";

  }
  else {
    $errorfield1 = "error_red_borders";
  }


  if (isset($_POST['Cinema_rows']) && !empty(isset($_POST['Cinema_rows']))){

    $crows = $_POST['Cinema_rows'];
    $crows = test_input($crows);
    $crows = filter_var($crows,FILTER_SANITIZE_NUMBER_INT);
    $errorfield1 = "";

  }
  else {
    $errorfield1 = "error_red_borders";
  }


  if (isset($_POST['Cinema_cols']) && !empty(isset($_POST['Cinema_cols']))){
    $ccols = $_POST['Cinema_cols'];
    $ccols = test_input($ccols);
    $ccols = filter_var($ccols,FILTER_SANITIZE_NUMBER_INT);
    $errorfield1 = "";

  }
  else {

    $errorfield1 = "error_red_borders";
  }

// SQL STATEMENT FOR UPDATING THE SELECTED CINEMA
$sql13 ="update `cinema_overview` set `Name`=\"".$ctitle."\", `rows` = \"".$crows."\", `cols` = \"".$ccols."\" where `id` =\"".$hid."\";";
$result13 = $conn->query($sql13);
if ($result13 === TRUE) {
  // SUCCESS MESSAGE
  echo "<script type='text/javascript'>
  alert('Cinema Hall edited succesfully!!');
  location='index.php';
  </script>";
}
// ERROR MESSAGE
else {echo "<script type='text/javascript'>
alert('Something's gone wrong. Please try again.');
location='admin_page.php#edit_cinema_hall_section';
</script>";}
// CLOSE THE CONNECTION AFTER ALL
$conn->close();
}
?>
