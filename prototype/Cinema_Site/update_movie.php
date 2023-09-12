<!-- UPDATE MOVIE FORM -->


<section id="edit_movie_section" style=" box-shadow: 0 0 15px 10px #000000" style="display:<?php echo $add_movie_section_hide; ?>;">
  <h2 style="text-align:center; color:#ffc107; padding-top:25px;">EDIT MOVIE</h2>
  <div class="container">
    <div class="row">
      <div class="col">
        <form method="get" action='#edit_movie_section'>
          <div class='form-group'>
            <?php
            // MAKE NEW CONNECTION
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "cinema";
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }
            // SQL STATEMENT FOR SHOWING ALL THE MOVIE TITLES IN A SELECT OPTION TAG IN ORDER TO SELECT THE MOVIE THAT ADMIN WANT TO CHANGE
            $sql7 ="select  Movie_title FROM movies";
            $result7 = $conn->query($sql7);
            if ($result7->num_rows > 0) {
              echo "
              <label id=edit_movie_label for=Movie Title >Choose Movie:</label>";
              echo "<select class='form-control' name='Movie_choice' id='Choose_movie_to_edit'>";
              while($row = $result7->fetch_assoc()) {
                $movie_title = $row['Movie_title'];
                echo "<option value='".$movie_title."'>".$movie_title."</option>";
              }
              echo  " </select>
              <input type='submit' id='choose_movie' class = 'form-control'  name='choose_movie' value='Choose' style= ' display:inline; background-color:#ffc107; color:#000000; margin-left: auto; margin-right: auto; width:10%;'>";
            }
            else {echo "No movies found";}
            echo "</div></form>";
            // IF ADMIN HAVE CHOSEN THEN SHOW ALL THE DATA OF THE SELECTED MOVIE IN A FORM
            if(isset($_GET['choose_movie'])){
              if(isset($_GET['Movie_choice'])){
                $choice_selected = $_GET['Movie_choice'];
                // SQL STATEMENT FOR SHOWING ALL THE DATA OF THE SELECTED MOVIE IN A FORM
                $sql9 = "select  movies.Movie_id, Movie_title, Movie_description, Movie_release_year, Movie_duration, Movie_trailer, Movie_image, Movie_gendre FROM movies WHERE Movie_title = '".$choice_selected."'";
                $result9 = $conn->query($sql9);

                if ($result9->num_rows > 0) {

                  while($row = $result9->fetch_assoc()) {
                    $movie_id = $row['Movie_id'];
                    $movietitle = $row['Movie_title'];
                    $moviedescription = $row['Movie_description'];
                    $moviereleaseyear = $row['Movie_release_year'];
                    $movieduration = $row['Movie_duration'];
                    $movietrailer = $row['Movie_trailer'];
                    $movieimage = $row['Movie_image'];
                    $moviegender = $row['Movie_gendre'];

                    echo "<form method='POST' action='edit_movie_result.php'>
                    <div class='form-group'>
                    <label id='edit_movie_label' for='Movie Title'>Title:</label>
                    <input  type='text' class='form-control edit_movie_input'  id='Movie_title' name='Movie_title_edit' placeholder='Enter Movie Title:' value='".$movietitle."' required></input>
                    <small id='edit_movie_title_instructions' class='form-text text-muted'>e.x Top Gun</small>
                    </div>
                    <div class='form-group'>
                    <label id='edit_movie_label' for='Movie Description'>Description:</label>
                    <textarea  class='form-control edit_movie_input' rows='4' cols='50' id='Movie_description' name='Movie_description_edit' placeholder='Enter description:' style='resize:both; overflow:auto;'  required>".$moviedescription."</textarea>
                    <small id='edit_movie_desc_instructions' class='form-text text-muted'>e.x During the end of the world Max and Paul get in trouble...</small>
                    </div>
                    <div class='form-group'>
                    <label id='edit_movie_label' for='Movie Release Year'>Release Year:</label>
                    <input  type='number' id='year_picker' name='year_picker_edit' class='form-control edit_movie_input'  placeholder='Enter Release Year:' style='width:20%;' value='".$moviereleaseyear."' required>
                    <small id='edit_movie_ry_instructions' class='form-text text-muted'>e.x 2009</small>
                    </div>
                    <div class= 'form-group' >
                    <label id= 'edit_movie_label'  for= 'Movie Duration' >Duration:</label>
                    <input id= 'duration_edit'  name='duration_edit'  type= 'text'   class= 'form-control edit_movie_input'    placeholder= 'Enter Duration:'  style= 'width:20%;' value='".$movieduration."' required>
                    <small id= 'edit_movie_duration_instructions'  class= 'form-text text-muted' >e.x 01:59:43(hh:mm:ss)</small>
                    </div>
                    <div class= 'form-group' >
                    <label id= 'edit_movie_label'  for= 'Movie Trailer' >Trailer:</label>
                    <input  id= 'trailer'  name= 'trailer_edit'  type= 'text'   class= 'form-control edit_movie_input'     placeholder='Enter Trailer URL:' value='".$movietrailer."'  required>
                    <small id= 'edit_movie_duration_instructions'  class= 'form-text text-muted' >e.x https://www.youtube.com/watch?v=eQJKxaiKN54 Select the part after the 'v='</small>
                      </div>
                      <div class= 'form-group' >
                      <label id= 'edit_movie_label'  for= 'Movie Image' >Image:</label>
                      <input  id= 'image'  name= 'image_edit'  type= 'url'   class= 'form-control edit_movie_input'    pattern= 'https://.*' placeholder='Enter Image URL:' value='".$movieimage."' required>
                        <small id= 'edit_movie_image_instructions'  class= 'form-text text-muted' >e.x https://example.com</small>
                          </div>
                          <div class= 'form-group' >
                          <label id= 'edit_movie_label'  for= 'Movie Gender' >Gender(s):</label>
                          <input id= 'gender'  name= 'gender_edit'  type= 'text'   class= 'form-control edit_movie_input'   placeholder= 'Enter Gender(s):' value='".$moviegender."'  required>
                          <small id= 'edit_movie_gender_instructions'  class= 'form-text text-muted' >e.x Action - Thriller - Horror</small>
                          <input type='hidden' id='imd' name='imd' value='".$movie_id."'></input>
                          </div>
                          <div class= 'form-group' >
                          <input  type= 'submit'   class='form-control' name='submit' id='submit'  style= 'background-color:#ffc107; color:#000000; margin-left: auto; margin-right: auto; width:20%;' value='Edit Movie'>
                          </div>
                          </form>
                          </div>
                          </div>
                          </div>";
                        }

                      }else{echo "NO MOVIE CONTENTS FOUND";}}}
                      // CLOSE CONNECTION
                      $conn->close();
                      ?>


                    </section>
