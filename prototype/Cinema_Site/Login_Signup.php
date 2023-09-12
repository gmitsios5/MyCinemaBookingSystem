<!-- LOGIN AND SIGNUP FORMS IN MODALS -->



<div id="myModal" class="modal fade modal-lg">
  <div class="modal-dialog modal-login">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Login</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <form action="login_result.php" method="post">
          <div class="form-group">

            <input type="text" class="form-control <?php echo $errorcolor;?>" placeholder="<?php echo $emailErr;?>" name="email" value="" required>
          </div>
          <div class="form-group">

            <input type="password" class="form-control" placeholder="Password" name="pword" value="" required>
          </div>
          <div class="form-group">
            <input type="submit" class="btnSubmit" name="loginsubmit" value="Login">
            <input type="reset" class="btnSubmit" value="Clear">
          </div>
        </form>

      </div>

    </div>
  </div>
</div>

<div id="myModal2" class="modal fade modal-lg">
  <div class="modal-dialog modal-login">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Sign Up</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <form action="reg_result.php" method="post">
          <div class="form-group">

            <input type="text" class="form-control" placeholder="First Name" name="fname" value="" required>
          </div>
          <div class="form-group">

            <input type="text" class="form-control" placeholder="Last Name" name="lname" value="" required>
          </div>
          <div class="form-group">

            <input type="text" class="form-control" placeholder="Username" name="uname" value="" required>
          </div>
          <div class="form-group">

            <input type="email" class="form-control <?php echo $errorcolor;?>" placeholder="<?php echo $emailErr;?>" name="email" value="" required>
          </div>
          <div class="form-group">

            <input type="password" class="form-control" placeholder="Password" name="pword" value="" required>
          </div>
          <div class="form-group">
            <input type="submit" class="btnSubmit" name="signupsubmit" value="Sign Up">
            <input type="reset" class="btnSubmit" value="Clear">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
