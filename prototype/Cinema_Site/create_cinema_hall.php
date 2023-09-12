<!-- FORM FOR CREATING NEW CINEMA WITH THE LABELS, INPUT FIELDS AND SMALL TAGS FOR FILLING CORRECTLY THE FIELDS -->
<section id="create_cinema_hall_section" style=" box-shadow: 0 0 15px 10px #000000" style="display:<?php echo $create_cinema_hall_section_hide; ?>;">
  <h2 style="text-align:center; color:#ffc107; padding-top:25px;">CREATE CINEMA HALL</h2>
  <div class="container">
    <div class="row">
      <div class="col">
        <form method="POST" action="create_cinema_hall_result.php">
          <div class="form-group">
            <label id="create_cinema_hall_label" for="Cinema Title" >Title:</label>
            <input  type="text" class="form-control add_movie_input " id="Cinema_title" name="Cinema_title" placeholder="Enter Hall Title:" required>
            <small id="create_cinema_hall_instructions" class="form-text text-muted">e.x Mykonos</small>
          </div>
          <div class="form-group">
            <label id="create_cinema_hall_label" for="Cinema rows">Rows:</label>
            <input type="number"  class="form-control add_movie_input " rows="4" cols="50" id="Cinema_rows" name="Cinema_rows" placeholder="Enter rows:" style="resize:both; overflow:auto;" required>
            <small id="create_cinema_hall_instructions" class="form-text text-muted">e.x 10</small>
          </div>
          <div class="form-group">
            <label id="create_cinema_hall_label" for="Cinema cols">Columns:</label>
            <input type="number"  class="form-control add_movie_input " rows="4" cols="50" id="Cinema_cols" name="Cinema_cols" placeholder="Enter columns:" style="resize:both; overflow:auto;" required>
            <small id="create_cinema_hall_instructions" class="form-text text-muted">e.x 12</small>
          </div>
          <div class="form-group">
            <input  type="submit"  class="form-control" style="background-color:#ffc107;; color:#000000; margin-left: auto; margin-right: auto; width:20%;" name="create_cinema_hall_btn" value="Create Hall">
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
