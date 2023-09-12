<!-- MAIN PAGE OF THE APPLICATION -->

<!DOCTYPE html>
<html lang="en">
<!--JAVASCRIPT SCRIPT FOR SECURING THE ACCESIBILITY TO THE COOKIES IS AVAILABLE ONLY FROM HTTP REQUESTS -->
<script>
function sessionStart($lifetime, $path, $domain, $secure, $httpOnly)
{
  session_set_cookie_params($lifetime, $path, $domain, $secure, $httpOnly);
  session_start();
}
sessionStart(0, '/', 'localhost', false, true);
</script>

<?php
// START SESSION FOR TRANSPORTING VALUES WITHIN THE PAGES
session_start();
// SET VISIBILITY FOR THE OPTIONS
$uname_echo = "";
$none_theaters = "none";
$none_uname ="none";
$none_movies = "none";
$add_movie_none = "none";
$add_movie_section_hide = "none";
$create_cinema_hall_section_hide = "none";
$edit_cinema_hall_section_hide = "none";
$phonebook = "";
$phonecheckout = "";
$checkout_none = "";
$mytickets_none = "";
// CHECK IF THE USER HAS ROLE AND USERNAME
if (isset($_SESSION["role"]) && isset($_SESSION["username"])){
  // CHECK IF HE USER IS GUEST OR NOTHING AND SHOW OR HIDE THE OPTIONS
  if (($_SESSION["role"])==="guest"|| ""){
    $none_movies = "block";
    $none_uname ="block";
    $add_movie_section_hide = "none";
    $edit_cinema_hall_section_hide = "none";
    $phonebook = "display:none;";
    $phonecheckout = "Checkout.php";


  }
  // CHECK IF USER ROLE IS ADMIN AND SHOW OR HIDE THE OPTIONS
  if (($_SESSION["role"])==="admin"){
    $none_uname ="block";
    $uname_echo = $_SESSION["username"];
    $none_theaters = "block";
    $add_movie_none = "block";
    $add_movie_section_hide = "block";
    $edit_cinema_hall_section_hide = "block";
    $mytickets_none = "none!important;";
  }
// CHECK IF USER ROLE IS EMPLOYEE AND SHOW OR HIDE THE OPTIONS
  if (($_SESSION["role"])==="employee"){
    $uname_echo = $_SESSION["username"];
    $none_movies = "block";
    $none_uname ="block";
    $add_movie_section_hide = "none";
    $edit_cinema_hall_section_hide = "none";
    $phonebook = "display:block;";
    $_SESSION["phonebook"] = $phonebook;
    $phonecheckout = "Phone_checkout";
    $_SESSION["phone_checkout_redirect"] = $phonecheckout;
    $checkout_none = "display:none;";
    $mytickets_none = "none;";

  }


}

?>
<?php
if (isset($_SESSION["role"]) && isset($_SESSION["username"])){

// CHECK IF USER ROLE IS GUEST ONLY AND SHOW OR HIDE THE OPTIONS
  if (($_SESSION["role"])=== "guest"){
    $none_uname ="block";
    $uname_echo = $_SESSION["username"];
    $none_theaters = "none";
    $add_movie_none = "none";
    $add_movie_section_hide = "none";
    $create_cinema_hall_section_hide = "none";
    $edit_cinema_hall_section_hide = "none";
    $phonebook = "display:none;";
    $_SESSION["phonebook"] = $phonebook;
    $phonecheckout = "Checkout";
    $_SESSION["phone_checkout_redirect"] = $phonecheckout;
  }
    // CHECK IF USER ROLE IS ADMIN AND SHOW OR HIDE THE OPTIONS
  else if (($_SESSION["role"])==="admin"){
    $none_uname ="block";
    $uname_echo = $_SESSION["username"];
    $none_theaters = "block";
    $add_movie_none = "block";
    $add_movie_section_hide = "block";
    $edit_cinema_hall_section_hide = "block";
    $phonebook = "display:none;";
    $_SESSION["phonebook"] = $phonebook;
    $phonecheckout = "Checkout";

  }
// CHECH IF THE LOGOUT BUTTON IS PRESSED, THEN SET OFF THE VISIBILITY OF THE OPTIONS AND CLOSE THE SESSION
  if (isset($_POST["logout"])){
    $none_movies = "none";
    $none_uname ="none";
    $none_theaters = "none";
    $add_movie_none = "none";
    $add_movie_section_hide = "none";
    session_destroy();
    // SUCCESS LOGOUT MESSAGE
    echo "<script type='text/javascript'>
    alert('You have succesfully logged out!!');
    location='index.php';
    </script>";

  }
}
?>


<head>

  <!-- MAIN PAGE -->
  <title>My Cinema Site</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
  <meta name="description" content="">
  <meta name="author" content="">

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <link href="css/navbar.css" rel="stylesheet">
  <link href="css/home.css" rel="stylesheet">
  <link href="css/login_signup.css" rel="stylesheet">
  <link href="css/movie_cards.css" rel="stylesheet">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">

<!-- STYLE OF MAIN PAGE OBJECTS -->
  <style>
  body{
    padding-right: 0px!important;
    background-color: black;
  }

  #myModal, #myModal2{
    margin-left: auto;
    margin-right: auto;
  }

  .modal-login {
    color: #636363;
    width: 350px;
    margin: 30px auto;
    text-align: center;

  }
  .modal-login .modal-content {
    padding: 20px;
    border-radius: 5px;
    border: none;
  }
  .modal-login .modal-header {
    border-bottom: none;
    position: relative;
    justify-content: center;
  }
  .modal-login h4 {
    text-align: center;
    font-size: 26px;
  }
  .modal-login  .form-group {
    position: relative;
  }
  .modal-login i {
    position: absolute;
    left: 13px;
    top: 11px;
    font-size: 18px;
  }
  .modal-login .form-control {
    padding-left: 40px;
  }
  .modal-login .form-control:focus {
    border-color: #00ce81;
  }
  .modal-login .form-control, .modal-login .btn {
    min-height: 40px;
    border-radius: 3px;
  }
  .modal-login .hint-text {
    text-align: center;
    padding-top: 10px;
  }
  .modal-login .close {
    position: absolute;
    top: -5px;
    right: -5px;
  }
  .modal-login .btn {
    background: #00ce81;
    border: none;
    line-height: normal;
  }
  .modal-login .btn:hover, .modal-login .btn:focus {
    background: #00bf78;
  }
  .modal-login .modal-footer {
    background: #ecf0f1;
    border-color: #dee4e7;
    text-align: center;
    margin: 0 -20px -20px;
    border-radius: 5px;
    font-size: 13px;
    justify-content: center;
  }
  .modal-login .modal-footer a {
    color: #999;
  }
  .trigger-btn {
    display: inline-block;
    margin: 100px auto;
  }

  body.modal-open {
    width: 100% !important;
    padding-right: 0 !important;
    overflow-y: scroll !important;
  }

  .ui-datepicker-calendar {
    display:none;
  }

  #add_movie_label,#edit_movie_label, #create_cinema_hall_label, #edit_cinema_hall_label{
    font-size:30px;
    color:#7b6f49;
  }
  .add_movie_input, .edit_movie_input{
    background-color: lightgray;
  }
  .error_red_borders{
    border: 1px solid red!important;

  }
  nav {
    background-color:black;
    box-shadow: 0 0 15px 10px #000000;
  }

  section{
    box-shadow: 0 0 15px 50px #000000!important;

  }
  </style>
</head>
<body>
  <!-- SHOW THE HEADER OF THE MAIN PAGE -->
  <?php include 'Header.php';?>


  <?php
  $errorcolor= $emailErr = "";
  $emailErr = "Email";
  $name = $email ="";
  // CHECK IF THERE IS A REQUEST FROM POST FORM
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // CHECH IF EMAIL FIELD IS EMPTY AND IF ISNT THEN FILTER THE INPUT
    if (empty($_POST["email"])) {
      $emailErr = "Email is required";
      $errorcolor = "error_red_borders";
    }
    else {
      $email = test_input($_POST["email"]);

      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
        $errorcolor = "error_red_borders";
      }
    }
  }

// FUNCTION FOR FILTERING THE DATA
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }


  ?>
<!-- SHOW LOGIN AND SIGNUP FORMS -->
  <?php include 'Login_Signup.php';
// CHECK FOR ROLES
  if (isset($_SESSION["role"])){
    // IF USER ROLE IS GUEST,THERE IS A POST REQUEST AND IF USER PRESSED THE BUTTON TO SELECT SEATS THEN SHOW THE SEAT RESERVATION PAGE
    if (($_SESSION["role"])==="guest"){
      if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST['gotoseats'])){
          echo "<section id='seat_reservation' style='".$checkout_none."'>";
          include 'Seat_reservation.php';
          echo "</section>";
        }
      }
    }
  }
// THEN IF USER IS GUEST SHOW THE CHECKOUT PAGE
  if (isset($_SESSION["role"])){
    if (($_SESSION["role"])==="guest"){
      echo "<section id='Checkout' style='".$checkout_none."'>";
      include 'Checkout.php';
      echo "</section>";
// ALSO SHOW THE TICKET HISTORY OF THE USER
      if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if (isset($_POST["mytickets"])){
          echo "<section id='My_tickets' style='".$checkout_none."'>";
          include 'My_tickets.php';
          echo "</section>";
        }
      }
    }

    // IF USER IS EMPLOYEE THEN ENABLE THE PHONE RESERVATION AND SHOW THE APPROPRIATE PAGE
    if (($_SESSION["role"])==="employee"){
      if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST['gotoseats'])){

          include 'Seat_reservation.php';

        }

      }
      echo "<section id='Phone_checkout' style='".$phonebook."'>";
      include 'Phone_checkout.php';
      echo "</section>";
    }
  }
  ?>





<!-- FOOTER WITH THE DEVELOPER'S COPYRIGHTS -->
  <footer style="width:100%;margin:auto; ">
    <p class="m-0 text-center text-white"style="font-size: 16px; background-color: transparent;">Copyright &copy; George Mitsios 2020 - <?php echo date('Y');?></p>
  </footer>
</body>

</html>
