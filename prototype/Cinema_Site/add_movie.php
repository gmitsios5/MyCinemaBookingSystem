<!-- ADD NEW MOVIE FORM -->

<section id="add_movie_section" style=" box-shadow: 0 0 15px 10px #000000" style="display:<?php echo $add_movie_section_hide; ?>;">
 <h2 style="text-align:center; color:#ffc107; padding-top:25px;">ADD MOVIE</h2>
  <div class="container">
    <div class="row">
      <div class="col">

        <!-- THIS IS THE FORM WITH LABELS FIELDS AND SMALL TAGS FOR HELPING TO FILL THE FIELDS PROPERLY -->
        <form method="POST" action="add_movie_result.php">
          <div class="form-group">
            <label id="add_movie_label" for="Movie Title" >Title:</label>
            <input  type="text" class="form-control add_movie_input " id="Movie_title" name="Movie_title" placeholder="Enter Movie Title:" required>
            <small id="add_movie_title_instructions" class="form-text text-muted">e.x Top Gun</small>
          </div>
          <div class="form-group">
            <label id="add_movie_label" for="Movie Description">Description:</label>
            <textarea  class="form-control add_movie_input " rows="4" cols="50" id="Movie_description" name="Movie_description" placeholder="Enter description:" style="resize:both; overflow:auto;" required></textarea>
            <small id="add_movie_desc_instructions" class="form-text text-muted">e.x During the end of the world Max and Paul get in trouble...</small>
          </div>
          <div class="form-group">
            <label id="add_movie_label" for="Movie Release Year">Release Year:</label>
            <input  type="text" id="year_picker" name="year_picker" class="form-control add_movie_input "  placeholder="Enter Release Year:" style="width:20%;"required>
            <small id="add_movie_ry_instructions" class="form-text text-muted">e.x 2009</small>
          </div>
          <div class="form-group">
            <label id="add_movie_label" for="Movie Duration">Duration:</label>
            <input id="duration" name="duration" type="text"  class="form-control add_movie_input "  placeholder="Enter Duration:" style="width:20%;"required>
            <small id="add_movie_duration_instructions" class="form-text text-muted">e.x 01:59:43(hh:mm:ss)</small>
          </div>
          <div class="form-group">
            <label id="add_movie_label" for="Movie Trailer">Trailer:</label>
            <input  id="trailer" name="trailer" type="url"  class="form-control add_movie_input "  pattern="https://.*" placeholder="Enter Trailer URL:" style=""required>
            <small id="add_movie_duration_instructions" class="form-text text-muted">e.x https://www.youtube.com/watch?v=eQJKxaiKN54 Select the part after the'v='</small>
          </div>
          <div class="form-group">
            <label id="add_movie_label" for="Movie Image">Image:</label>
            <input  id="image" name="image" type="url"  class="form-control add_movie_input "  pattern="https://.*" placeholder="Enter Image URL:" style=""required>
            <small id="add_movie_image_instructions" class="form-text text-muted">e.x https://example.com</small>
          </div>
          <div class="form-group">
            <label id="add_movie_label" for="Movie Gender">Gender(s):</label>
            <input id="gender" name="gender" type="text"  class="form-control add_movie_input " placeholder="Enter Gender(s):" style=""required>
            <small id="add_movie_gender_instructions" class="form-text text-muted">e.x Action - Thriller - Horror</small>
          </div>
          <div class="form-group">
            <input  type="submit"  class="form-control" style="background-color:#ffc107;; color:#000000; margin-left: auto; margin-right: auto; width:20%;" value="Add Movie" style="">
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
