<?php

//if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
if(session_id() == '' || !isset($_SESSION)){session_start();}

?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact || Style BAZAAR</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
  </head>
  <body>

   <?php include 'header.php'; ?>

    <div class="row" style="margin-top:30px;">
      <div class="small-12">

        <p>Please contact this number <a href="mailto:apjadon7895@gmail.com">+91-9999999999</a></p> 
        <p>Wanna get in touch. Email us at <a href="mailto:apjadon7895@gmail.com">apjadon7895@gmail.com</a></p>
        
    <?php include 'footer.php'; ?>

      </div>
    </div>


    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
  </body>
</html>
