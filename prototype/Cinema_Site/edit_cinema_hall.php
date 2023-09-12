<!-- SECTION WITH EDIT CINEMA FORM -->

<section id="edit_cinema_hall_section" style=" box-shadow: 0 0 15px 10px #000000" style="display:<?php echo $edit_cinema_hall_section_hide; ?>!important;">
  <h2 style="text-align:center; color:#ffc107; padding-top:25px;">EDIT CINEMA HALL</h2>
  <div class="container">
    <div class="row">
      <div class="col">
        <form method='get' action='#edit_cinema_hall_section'>
          <div class='form-group'>
            <?php
            // CONNECT WITH DATABASE WITH THE APPROPRIATE CREDENTIALS
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "cinema";
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }
            // GET OWNER ID WITH SESSION
            $own_id = $_SESSION['id'];
            // SQL STATEMENT FOR SHOWING THE NAME OF OWNER'S CINEMAS IN ORDER TO SELECT ONE
            $sql11 ="select Name FROM `cinema_overview` WHERE owner_id = '".$own_id."'";
            $result11 = $conn->query($sql11);
            if ($result11->num_rows > 0) {

              echo "<label id='edit_cinema_hall_label' for='Hall Title'>Choose Hall:</label>";
              echo "<select class='form-control' name='Hall_choice' id='Choose_Hall_to_edit' style='width:20%;'>";
              while($row = $result11->fetch_assoc()) {
                $hall_title = $row['Name'];
                echo "<option value='".$hall_title."'>".$hall_title."</option>";
              }
              echo  " </select>
              <input type='submit' id='edit_cinema_hall' class = 'form-control'  name='choose_hall' value='Choose' style= ' display:inline; background-color:#ffc107; color:#000000; margin-left: auto; margin-right: auto; width:10%;'>";
            }
            else {echo "No halls found";}
            echo '</div></form>';
            if(isset($_GET['choose_hall'])){
              if(isset($_GET['Hall_choice'])){

                $hall_choice_selected = $_GET['Hall_choice'];

                // SQL STATEMENT FOR SHOWING ALL THE DATE OF THE SELECTED CINEMA
                $sql12 = "select * FROM `cinema_overview` WHERE Name ='".$hall_choice_selected."'";
                $result12 = $conn->query($sql12);

                if ($result12->num_rows > 0) {

                  while($row = $result12->fetch_assoc()) {
                    $hall_id = $row['id'];
                    $hall_title = $row['Name'];
                    $hall_rows = $row['rows'];
                    $hall_cols = $row['cols'];

                    // FORM WITH THE CINEMA FIELDS READY FOR CHANGES
                    echo "<form method='POST' action='edit_cinema_hall_result.php'>
                    <div class='form-group'>
                    <label id='edit_cinema_hall_label' for='Hall Title' >Title:</label>
                    <input  type='text' class='form-control add_movie_input ' id='Hall_title' name='Cinema_title' value='".$hall_title."' placeholder='Enter Hall Title:' required>

                    </div>
                    <div class='form-group'>
                    <label id='edit_cinema_hall_label' for='Cinema rows'>Rows:</label>
                    <input type='number'  class='form-control add_movie_input' rows='4' cols='50' id='Cinema_rows' name='Cinema_rows' value='".$hall_rows."' placeholder='Enter rows:' style='resize:both; overflow:auto;' required>

                    </div>
                    <div class='form-group'>
                    <label id='edit_cinema_hall_label' for='Cinema cols'>Columns:</label>
                    <input type='number'  class='form-control add_movie_input' rows='4' cols='50' id='Cinema_cols' name='Cinema_cols' value='".$hall_cols."' placeholder='Enter columns:' style='resize:both; overflow:auto;' required>

                    </div>
                    <div class='form-group'>
                    <input  type='submit'  class='form-control' style='background-color:#ffc107; color:#000000; margin-left: auto; margin-right: auto; width:20%;' name='edit_cinema_hall_btn' value='Edit Hall'>
                    <input type='hidden' id='hid' name='hid' value='".$hall_id."'></input>
                    </div>
                    </form>
                    </div>";}}
                    // ERROR MESSAGE
                    else {echo "Halls Not Found";}}}
                    // CLOSE CONNECTION AFTER ALL
                    $conn->close();
                    ?>
                  </div>
                </div>
              </section>
