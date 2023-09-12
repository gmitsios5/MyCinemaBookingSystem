<!-- NEW REGISTRATION RESULT -->

<?php

// MAKE NEW DATABASE CONNECTION
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cinema";

// INITIALIZE DATA
$email=$pword =$user_name=$first_name=$last_name="";
$email= $_POST['email'];
$pword = $_POST['pword'];
$user_name= $_POST['uname'];
$first_name= $_POST['fname'];
$last_name= $_POST['lname'];
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// FUNCTION FOR FILTERING DATA
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
// CHECK IF THERE IS A REQUES FROM A POST FORM
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // CHECK IF THE SIGN UP BUTTON IS PRESSED
  if (isset($_POST["signupsubmit"])){

    // CHECK IF THE FIELDS ARE CORRECTLY FILLED ADN FILTER THE DATA
    if (isset($_POST['fname']) && !empty(isset($_POST['fname']))){

      $first_name = $_POST['fname'];
      $first_name = test_input($first_name);
      $errorfield1 = "";
      $first_name = filter_var($first_name,FILTER_SANITIZE_STRING);

    }
    else {

      $errorfield1 = "error_red_borders";
    }
    if (isset($_POST['lname']) && !empty(isset($_POST['lname']))){
      $last_name = $_POST['lname'];
      $last_name = test_input($last_name);
      $errorfield1 = "";
      $last_name = filter_var($last_name,FILTER_SANITIZE_STRING);
    }
    else {

      $errorfield1 = "error_red_borders";
    }
    if (isset($_POST['uname']) && !empty(isset($_POST['uname']))){
      $user_name = $_POST['uname'];
      $user_name = test_input($user_name);
      $errorfield1 = "";

    }
    else {

      $errorfield1 = "error_red_borders";
    }

    if (isset($_POST['email']) && !empty(isset($_POST['email']))){
      $email = $_POST['email'];
      $email = test_input($email);
      $errorfield1 = "";
      $email = filter_var($email,FILTER_SANITIZE_EMAIL);
    }
    else {

      $errorfield1 = "error_red_borders";
    }

    if (isset($_POST['pword']) && !empty(isset($_POST['pword']))){
      $pword = $_POST['pword'];
      $pword = test_input($pword);
      $errorfield1 = "";

    }
    else {

      $errorfield1 = "error_red_borders";
    }
  }

// SQL STATEMENT FOR INSERTING NEW USER
  $sql = "INSERT INTO users (username, password, email,First_Name,Last_Name) VALUES ('$user_name',md5('$pword'),'$email','$first_name','$last_name')";
  if ($conn->query($sql) === TRUE) {

    // SUCCESS MESSAGE
    echo "<script type='text/javascript'>
    alert('You have signed in succesfully. Now go to login!');
    location='index.php';
    </script>";
  } else {
    // ERROR MESSAGE
    echo "Error: " . $sql . "<br>" . $conn->error;
  }}
  // CLOSE CONNECTION
  $conn->close();
  ?>
