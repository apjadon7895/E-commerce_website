<?php

// Start session if not already started
if(session_id() == '' || !isset($_SESSION)){ session_start(); }

// Redirect if the user is already logged in
if (isset($_SESSION["email"])) {
    header("location:index.php");
    exit();
}

?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register || Style BAZAAR</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
  </head>
  <body>

    <?php include 'header.php'; ?>

    <form method="POST" action="insert.php" style="margin-top:30px;">
      <div class="row">
        <div class="small-8">

          <div class="row">
            <div class="small-4 columns">
              <label for="fname" class="right inline">First Name</label>
            </div>
            <div class="small-8 columns">
              <input type="text" id="fname" placeholder="Enter First Name" name="fname" required>
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
              <label for="lname" class="right inline">Last Name</label>
            </div>
            <div class="small-8 columns">
              <input type="text" id="lname" placeholder="Enter Last Name" name="lname" required>
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
              <label for="address" class="right inline">Address</label>
            </div>
            <div class="small-8 columns">
              <input type="text" id="address" placeholder="Enter Your Address" name="address" required>
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
              <label for="city" class="right inline">City</label>
            </div>
            <div class="small-8 columns">
              <input type="text" id="city" placeholder="Enter City" name="city" required>
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
              <label for="pin" class="right inline">Pin Code</label>
            </div>
            <div class="small-8 columns">
              <input type="number" id="pin" placeholder="Enter Pincode" name="pin" required>
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
              <label for="email" class="right inline">E-Mail</label>
            </div>
            <div class="small-8 columns">
              <input type="email" id="email" placeholder="Enter Your Email Address" name="email" required>
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
              <label for="pwd" class="right inline">Password</label>
            </div>
            <div class="small-8 columns">
              <input type="password" id="pwd" name="pwd" required>
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
              <label for="re_pwd" class="right inline">Re-Password</label>
            </div>
            <div class="small-8 columns">
              <input type="password" id="re_pwd" name="re_pwd" required>
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
            </div>
            <div class="small-8 columns">
              <input type="submit" value="Register" style="background: #0078A0; border: none; color: #fff; font-family: 'Helvetica Neue', sans-serif; font-size: 1em; padding: 10px;">
              <input type="reset" value="Reset" style="background: #0078A0; border: none; color: #fff; font-family: 'Helvetica Neue', sans-serif; font-size: 1em; padding: 10px;">
            </div>
          </div>
        </div>
      </div>
    </form>

    <?php include 'footer.php'; ?>

    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
  </body>
</html>
