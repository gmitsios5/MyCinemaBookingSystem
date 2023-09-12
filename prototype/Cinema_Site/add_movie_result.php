<!-- ADD MOVIE RESULTS -->



<?php
// CONNECTION TO THE DATABASE WITH THE APPROPRIATE CREDENTIALS
$errorfield1 = "";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cinema";
$title;
$description;
$release_year;
$duration;
$trailer;
$image ;
$gender ;
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// FUNCTION WHICH FILTERS THE DATA FROM THE POST/GET CALLS
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
// CHECK IF POST CALLS ARE REQUESTED
if ($_SERVER["REQUEST_METHOD"] == "POST"){

// CHECK IF FORM FIELDS ARE FILLED AND IF THEY ARE FILTERED

  if (isset($_POST["Movie_title"]) && !empty(isset($_POST["Movie_title"]))){
    $title = $_POST["Movie_title"];
    $title = test_input($title);
    $errorfield1 = "";
    $title = filter_var($title,FILTER_SANITIZE_STRING);

  }
  else {

    $errorfield1 = "error_red_borders";
  }
  if (isset($_POST["Movie_description"]) && !empty(isset($_POST["Movie_description"]))){
    $description = $_POST["Movie_description"];
    $description = test_input($description);
    $errorfield1 = "";
    $description = filter_var($description,FILTER_SANITIZE_STRING);
  }
  else {

    $errorfield1 = "error_red_borders";
  }
  if (isset($_POST["year_picker"]) && !empty(isset($_POST["year_picker"]))){
    $release_year = $_POST["year_picker"];
    $release_year = test_input($release_year);
    $errorfield1 = "";
    $release_year = filter_var($release_year,FILTER_SANITIZE_NUMBER_INT);
  }
  else {

    $errorfield1 = "error_red_borders";
  }

  if (isset($_POST["duration"]) && !empty(isset($_POST["duration"]))){
    $duration = $_POST["duration"];
    $duration = test_input($duration);
    $errorfield1 = "";
    $duration = filter_var($duration,FILTER_SANITIZE_STRING);
  }
  else {

    $errorfield1 = "error_red_borders";
  }

  if (isset($_POST["trailer"]) && !empty(isset($_POST["trailer"]))){
    $trailer = $_POST["trailer"];
    $trailer = test_input($trailer);
    $errorfield1 = "";
    $trailer = filter_var($trailer,FILTER_SANITIZE_URL);
  }
  else {

    $errorfield1 = "error_red_borders";
  }
  if (isset($_POST["image"]) && !empty(isset($_POST["image"]))){
$image = $_POST["image"];
    $image = test_input($image);
    $errorfield1 = "";
    $image = filter_var($image,FILTER_SANITIZE_URL);
  }
  else {

    $errorfield1 = "error_red_borders";
  }

  if (isset($_POST["gender"]) && !empty(isset($_POST["gender"]))){
    $gender = $_POST["gender"];
    $gender = test_input($gender);
    $errorfield1 = "";
    $gender = filter_var($gender,FILTER_SANITIZE_STRING);

  }
  else {
    $errorfield1 = "error_red_borders";
  }
}



// SQL STATEMENT FOR INSERT NEW MOVIE
$sql_insert_movie = "insert into movies (Movie_title,Movie_description, Movie_release_year, Movie_duration, Movie_trailer, Movie_image, Movie_gendre)
VALUES
('".$title."','".$description."','".$release_year."','".$duration."', '".$trailer."','".$image."','".$gender."')";
$result = $conn->query($sql_insert_movie);

// MESSAGE FOR SUCCESFULL INSERTION
if ($result === TRUE) {
  echo "<script type='text/javascript'>
  alert('Movie added succesfully!!');
  location='index.php';
  </script>";
}

else{
  echo "Error: " . $sqlin . "<br>" . $conn->error;
}

// CLOSE THE CONNECTION AFTER ALL HAVE FINISHED
$conn->close();



?>
