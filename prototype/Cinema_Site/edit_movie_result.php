<!-- EDIT MOVIE RESULT PAGE -->


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
// INITIALIZE DATA
$imd = $_POST['imd'];
$mtitle;
$mdescription;
$mreleaseyear;
$mduration;
$mtrailer;
$mimage;
$mgender;
// FUNCTION FOR FILTERING THE DATA
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
// CHECK IF THERE IS A POST REQUEST
if ($_SERVER["REQUEST_METHOD"] == "POST"){
  // CHECK IF THE SUBMIT BUTTON IS PRESSED
  if (isset($_POST["submit"])){
    // CHECK IF THE FIELDS ARE PROPERLY FILLED AND THEY ARE NOT EMPTY AND FILTER THE DATA
    if (isset($_POST["Movie_title_edit"]) && !empty(isset($_POST["Movie_title_edit"]))){
      $mtitle = $_POST["Movie_title_edit"];
      $mtitle = test_input($mtitle);
      $errorfield1 = "";
      $mtitle = filter_var($mtitle,FILTER_SANITIZE_STRING);

    }
    else {

      $errorfield1 = "error_red_borders";
    }
    if (isset($_POST["Movie_description_edit"]) && !empty(isset($_POST["Movie_description_edit"]))){
      $mdescription = $_POST["Movie_description_edit"];
      $mdescription = test_input($mdescription);
      $errorfield1 = "";
      $mdescription = filter_var($mdescription,FILTER_SANITIZE_STRING);
    }
    else {

      $errorfield1 = "error_red_borders";
    }
    if (isset($_POST["year_picker_edit"]) && !empty(isset($_POST["year_picker_edit"]))){
      $mreleaseyear = $_POST["year_picker_edit"];
      $mreleaseyear = test_input($mreleaseyear);
      $errorfield1 = "";
      $mreleaseyear = filter_var($mreleaseyear,FILTER_SANITIZE_NUMBER_INT);
    }
    else {

      $errorfield1 = "error_red_borders";
    }

    if (isset($_POST["duration_edit"]) && !empty(isset($_POST["duration_edit"]))){
      $mduration = $_POST["duration_edit"];
      $mduration = test_input($mduration);
      $errorfield1 = "";
      $mduration = filter_var($mduration,FILTER_SANITIZE_STRING);
    }
    else {

      $errorfield1 = "error_red_borders";
    }

    if (isset($_POST["trailer_edit"]) && !empty(isset($_POST["trailer_edit"]))){
      $mtrailer = $_POST["trailer_edit"];
      $mtrailer = test_input($mtrailer);
      $errorfield1 = "";
      $mtrailer = filter_var($mtrailer,FILTER_SANITIZE_URL);
    }
    else {

      $errorfield1 = "error_red_borders";
    }
    if (isset($_POST["image_edit"]) && !empty(isset($_POST["image_edit"]))){
      $mimage = $_POST["image_edit"];
      $mimage = test_input($mimage);
      $errorfield1 = "";
      $mimage = filter_var($mimage,FILTER_SANITIZE_URL);
    }
    else {

      $errorfield1 = "error_red_borders";
    }

    if (isset($_POST["gender_edit"]) && !empty(isset($_POST["gender_edit"]))){
$mgender = $_POST["gender_edit"];
      $mgender = test_input($mgender);
      $errorfield1 = "";
      $mgender = filter_var($mgender,FILTER_SANITIZE_STRING);

    }
    else {
      $errorfield1 = "error_red_borders";
    }
  }
}



// SQL STATEMENT FOR UPDATING MOVIE
$sql10 ="update movies set Movie_title=\"".$mtitle."\", Movie_description = \"".$mdescription."\", Movie_release_year = \"".$mreleaseyear."\", Movie_duration = \"".$mduration."\", Movie_trailer = \"".$mtrailer."\", Movie_image = \"".$mimage."\", Movie_gendre = \"".$mgender."\" where Movie_id =\"".$imd."\";";
$result10 = $conn->query($sql10);
if ($result10 === TRUE) {
  // SUCCESS MESSAGE
  echo "<script type='text/javascript'>
  alert('Movie edited succesfully!!');
  location='index.php';
  </script>";
}
else {
  // ERROR MESSAGE
  echo "<script type='text/javascript'>
  alert('Something's wrong...check your input fields!!');
  location='admin_page.php#edit_movie_section';
  </script>";

  echo "Nothing changed<br>".$sql10;}
// CLOSE THE CONNECTION WITH DATABASE AFTER ALL
  $conn->close();
?>
