<!-- ADD NEW PROJECTION DATE AND TIME FORM -->

<section id="add_projection_time_section" style=" box-shadow: 0 0 15px 10px #000000" style="display:<?php ?>;">
  <h2 style="text-align:center; color:#ffc107; padding-top:25px;">MAKE PROJECTION DATE & TIME</h2>
  <div class="container">
    <div class="row">
      <div class="col">

        <!-- THIS IS THE FORM WITH LABELS, FIELDS AND SMALL TAGS FOR HELPING TO FILL THE FIELDS PROPERLY -->
        <form method="POST" action="projection_time_result.php">
          <div class="form-group">
            <label id="add_movie_label" for="Movie Description">Date:</label>
            <input type="date" id="year_picker" name="year_picker" class="form-control add_movie_input "  placeholder="Choose Date" style="" required>
            <small id="add_movie_desc_instructions" class="form-text text-muted">e.x Choose a date from the date picker.</small>
          </div>
          <div class="form-group">
            <label id="add_movie_label" for="Movie Release Year">Time:</label>
            <input  type="text" id="select_time" name="select_time" class="form-control add_movie_input "  placeholder="Type time:" style="width:20%;"required>
            <small id="add_movie_ry_instructions" class="form-text text-muted">e.x 14:45:00(hh:mm:ss)</small>
          </div>
          <div class="form-group">
            <input  type="submit"  class="form-control" style="background-color:#ffc107;; color:#000000; margin-left: auto; margin-right: auto; width:25%;" value="Add Date & Time" style="">
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
