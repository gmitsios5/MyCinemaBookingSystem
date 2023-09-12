<!-- THIS IS THE ADMIN MAIN PAGE FOR ADDING AND UPDATING MOVIE'S, CINEMA'S, AND PROJECTION DATA -->

<!DOCTYPE html>
<html lang="en">

<!-- JAVASCRIPT SCRIPT FOR SECURING THE ACCESIBILITY TO THE COOKIES IS AVAILABLE ONLY FROM HTTP REQUESTS -->
<script>
function sessionStart($lifetime, $path, $domain, $secure, $httpOnly)
{
  session_set_cookie_params($lifetime, $path, $domain, $secure, $httpOnly);
  session_start();
}
sessionStart(0, '/', 'localhost', false, true);
</script>
<?php
// START A SESSION TO TRANSPORT DATA FROM ONE PAGE TO ANOTHER
session_start();
// INITIALIZE DATA FOR USING THEM SAFELY
$uname_echo = "";
$none_theaters = "none";
$none_uname ="none";
$none_movies = "none";
$add_movie_none = "none";
$add_movie_section_hide = "none";
$create_cinema_hall_section_hide = "none";
$edit_cinema_hall_section_hide = "none";
$mytickets_none2="";
?>
<?php
// CHECK AFTER THE LOGIN IF THE USER IS ADMIN AND SHOW THE ADMIN FORMS
if (isset($_SESSION["role"]) && isset($_SESSION["username"]) ){
  if (($_SESSION["role"])==="admin"){
    $none_uname ="block";
    $uname_echo = $_SESSION["username"];
    $none_theaters = "block";
    $add_movie_none = "block";
    $add_movie_section_hide = "block";
    $edit_cinema_hall_section_hide = "block";
    $mytickets_none2 = "none!important;";
  }
// CHECK IF THE ADMIN HAVE LOGGED OUT AND IF TRUE THEN DESTROY THE SESSION AND SHOW MESSAGE
  if (isset($_POST["logout"])){
    session_destroy();
    echo "<script type='text/javascript'>
    alert('You have succesfully logged out!!');
    location='index.php';
    </script>";


  }
}
?>

<!-- MAIN ADMIN PAGE -->
<head>
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

<!-- STYLE FOR PAGE OBJECTS -->
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
  </style>
</head>
<body>
  <!-- SHOW HEADER FOR ADMIN PAGE -->
  <?php include 'Header_admin.php';?>


  <?php
  $errorcolor= $emailErr = "";
  $emailErr = "Email";
  $name = $email ="";
  // CHECK FOR POST CALL FROM LOGIN FORM AND THE FIELDS IF THEY ARE PROPERLY FIELD WITH THE CORRECT DATA AND THEN FILTER THE DATA
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["email"])) {
      $emailErr = "Email is required";
      $errorcolor = "errorcolor";
    }
    else {
      $email = test_input($_POST["email"]);

      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
        $errorcolor = "errorcolor";
      }
    }
  }

// FUNCTION WHICH FILTERS THE DATA WITH TRIMMING STRIPPING THE SLASHES AND ENCODE HTML SPECIAL CHARS
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  ?>
<!-- SHOW LOGIN AND SIGN UP FORMS -->
  <?php include 'Login_Signup.php';?>
  <hr style="border: 1px solid #ffc107;">
<!-- SHOW ADD NEW MOVIE FORM -->
  <?php include 'add_movie.php'; ?>
  <hr style="border: 1px solid #ffc107;">
<!-- SHOW UPDATE MOVIE FORM -->
  <?php include 'update_movie.php'; ?>
  <hr style="border: 1px solid #ffc107;">
<!-- SHOW CREATE NEW CINEMA FORM -->
  <?php include 'create_cinema_hall.php'; ?>
  <hr style="border: 1px solid #ffc107;">
<!-- SHOW UPDATE  CINEMA  FORM -->
  <?php include 'edit_cinema_hall.php'; ?>
  <hr style="border: 1px solid #ffc107;">
<!-- SHOW ADD PROJECTION DATE AND TIME FORM -->
  <?php include 'add_projection_time.php'; ?>
  <hr style="border: 1px solid #ffc107;">
<!-- SHOW ADD PROJECTION TO MOVIE FORM -->
  <?php include 'add_projection.php'; ?>
  <hr style="border: 1px solid #ffc107;">
<!-- SHOW THE LAYOUT OF THE CURRENT ADMIN'S CINEMAS -->
  <?php include 'Cinema_Overview.php'; ?>
  <hr style="border: 1px solid #ffc107;">

  <!-- FOOTER WITH THE COPYRIGHTS OF THE DEVELOPER  -->
  <footer style="width:100%;margin:auto; ">
    <p class="m-0 text-center text-white"style="font-size: 16px; background-color: transparent;">Copyright &copy; George Mitsios 2020 - <?php echo date('Y');?></p>
  </footer>
</body>
</html>
