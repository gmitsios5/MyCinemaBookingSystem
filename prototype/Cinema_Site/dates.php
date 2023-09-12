<?php
// START A SESSION FOR TRANSPORTING VALUES WITHIN THE PAGES
session_start();
header('Content-type: application/json');

// CONNECTION WITH DATABASE WITH THE APPROPRIATE CREDENTIALS
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cinema";
$selectedDate;
$mid;
$checkerror= true;

// Set the data of the file in json format and decode the to array
$data = json_decode(file_get_contents('php://input'),true);
if (isset($data['date']) && isset($data['mid'])){
  $selectedDate = $data['date'];
  $mid = $data['mid'];
}else{$checkerror = false;}
if ($checkerror){
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
// SQL STATEMENT FOR SHOWING MOVIE'S PROJECTION DATA
  $sql4 ="select distinct Movie_id, projection.Projection_id, projection_time.Projection_Date, projection_time.Projection_Time, cinema_overview.Name from projection
  join projection_time on projection.projection_time_id = projection_time.Projection_Time_id
  join cinema_overview on cinema_overview.id = projection.cinema_id
  where Projection_Time.Projection_Date ='".$selectedDate."' and movie_id = ".$mid." ORDER by Projection_Time.Projection_Time ASC";
  $result4 = $conn->query($sql4);
  if ($result4->num_rows > 0) {
    $results;
    $count = 0;

    while($row = $result4->fetch_assoc()) {
      // GET THE RESULTS IN A TABLE WITH TWO DIMENSIONS

      $results[$count]['Projection_id']= $row['Projection_id'];
      $results[$count]['Projection_Date']= $row['Projection_Date'];
      $results[$count]['Projection_Time']= $row['Projection_Time'];
      $count++;
    }
    // ENCODE RESULT TO JSON
    echo json_encode($results);
  }
}
?>
