<!-- PAGE WITH ALL THE ADMIN CINEMAS LAYOUT -->

<section id='cinemaov'>
<?php
// CONNECTION WITH DATABASE WITH THE APPROPRIATE CREDENTIALS
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cinema";
$conn = new mysqli($servername, $username, $password, $dbname);
$c_owner_id ="";
// SESSION WITH THE ADMIN ID
$c_owner_id =$_SESSION["id"];
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error); }
  // SQL STATEMENT FOR SHOWING ROWS, COLUMNS, NAME FROM ALL THE CINEMA'S OF THE ADMIN
  $sql = "select `Name`, `rows`, `cols` FROM `cinema_overview` where `Owner_id`='".$c_owner_id."'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
echo "<h1 style='color:#ffc107;text-align:center;'>Your Halls:</h1>";
    while($row = $result->fetch_assoc()) {
      $cname = $row["Name"];
      $crows = $row["rows"];
      $ccols = $row["cols"];

      echo "<h1 style='color:#ffc107;text-align:center;'>".$cname."</h1>
      <table style='margin-left:auto; margin-right:auto;'>";
      for($i=1;$i<=$crows;$i++)
      {
        echo "<tr>";
        for ($j=1;$j<=$ccols;$j++)
        {
          echo "<td style='"."background-color:#ffc107;"."'><button class="."btn-primary"." style="."width:100%; color:green;"."><a>".chr(64 + $i).".".$j."</a></button></td>";
        }
        echo "</tr>";
      }
echo "</table>";
    }     }
    // ERROR MESSAGE
    else {    echo "You do not have created any cinema halls!"; }
    // CLOSE THE CONNECTION WITH DATABASE AFTER ALL
    $conn->close(); ?>
</section>
