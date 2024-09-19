<?php

//if (session_status() !== PHP_SESSION_ACTIVE) {session_start();} for php 5.4 and above

if(session_id() == '' || !isset($_SESSION)){session_start();}


?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>About Us || Style BAZAAR</title>
    <link rel="stylesheet" href="css/foundation.css" />
    
    <script src="js/vendor/modernizr.js"></script>
  </head>
  
  <body>

 <?php include 'header.php'; ?>




    <div class="row" style="margin-top:30px;">
      <div class="small-12">
        

<!--===== ABOUT =====-->
<section class="about section bd-container" id="about">
  <span class="section-subtitle">My history</span>
  <h2 class="section-title">About me</h2>

  <div class="about__container bd-grid">
    <div class="about__data bd-grid">
      <p class="about__description"><span>Hello, I am <br></span>Freelance frontend developer, I am passionate about creating and developing web interfaces. With years of experience in web design and development.</p>

      <div>
        <span class="about__number">02</span>
        <span class="about__achievement">Years off Experience</span>
      </div>

      <div>
        <span class="about__number">10+</span>
        <span class="about__achievement">Projects completes</span>
      </div>

      <div>
        <span class="about__number">05</span>
        <span class="about__achievement">Best work awards</span>
      </div>
    </div>
  </div>
</section>


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
