<?php
// START A SESSION IN ORDER TO TRANSPORT VALUES WITHIN THE PAGES
session_start();
// MAKE A NEW CONNECTION WITH DATABASE
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cinema";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// FUNCTION FOR FILTERING THE DATA
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
// IF THERE IS A POST REQUEST THEN CHECK IF THE LOGIN BUTTON IS PRESSED AND THEN CHECK
// IF THE EMAIL FIELD IS EMPTY. IF NOT THEN FILTER THE DATA. DO THE SAME WITH THE PASSWORD
if ($_SERVER["REQUEST_METHOD"] == "POST"){
  if (isset($_POST["loginsubmit"])){
    if (isset($_POST['email']) && !empty(isset($_POST['email']))){

      $email= $_POST['email'];
      $errorfield1 = "";
      $email = filter_var($email,FILTER_SANITIZE_EMAIL);

    }
    else {

      $errorfield1 = "error_red_borders";
    }
    if (isset($_POST['pword']) && !empty(isset($_POST['pword']))){

      $pword = $_POST['pword'];
      $val_pword = md5($pword);
      $errorfield1 = "";

    }
    else {

      $errorfield1 = "error_red_borders";
    }


    // SQL STATEMENT FOR SHOWING CURRENT USER DATA
    $sql = "select * FROM users WHERE email='".$email."'  AND password= '".$val_pword."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        // MAKE SESSIONS WITH THE NAME, ROLE AND ID OF THE USER
        $_SESSION["username"] = $row["username"];
        $_SESSION["role"] = $row["Role"];
        $_SESSION["id"] = $row["id"];
        // SUCCESS LOGIN MESSAGE
        echo "<script type='text/javascript'>
        alert('You have logged in succesfully!!');
        location='index.php';
        </script>";

      }
    }
    // ERROR LOGIN MESSAGE
    else {  echo "<script type='text/javascript'>
      alert('Your username or your password is invalid. Try again!!');
      location='index.php';
      </script>"; }
    }
  }
  // CLOSE THE CONNECTION
  $conn->close();

  ?>
