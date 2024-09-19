<?php

//if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
if(session_id() == '' || !isset($_SESSION)){session_start();}

?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Style BAZAAR</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
  </head>
  <style>
      *,
*::before,
*::after {
  box-sizing: border-box;
  margin: 0;
}

img {
  display: block;
  width: 100%;
  max-width: 1500px;
}

body {
  background: #000;
  color: white;
  width:100%;
  max-width: 1500px;
  margin: 0 auto;
}

section {
  margin: 5rem 2rem;
}

/* Navigation Styles */

header {
  background: black;
  text-align: center;
  position: fixed;
  top: 0;
  z-index: 1000;
  width: 100%;
  max-width: 1500px;
}

.logo {
  font-size: 1.25rem;
  margin: 1rem;
  text-transform: uppercase;
}

nav {
  position: absolute;
  top: 100%;
  left: 0;
  text-align: left;
  background: black;
  width: 100%;
  height: 100vh;
  padding-top: 2rem;
  display: none;
}

.nav-toggle {
  display: none;
}

.nav-toggle-label {
  position: absolute;
  top: 0;
  left: 0;
  margin-left: 1em;
  height: 100%;
  display: flex;
  align-items: center;
  cursor: pointer;
}

.nav-toggle-label span,
.nav-toggle-label span::before,
.nav-toggle-label span::after {
  display: block;
  background: white;
  height: 2px;
  width: 2em;
  border-radius: 2px;
  position: relative;
}

.nav-toggle-label span::before,
.nav-toggle-label span::after {
  content: '';
  position: absolute;
}

.nav-toggle-label span::before {
  bottom: 7px;
}

.nav-toggle-label span::after {
  top: 7px;
}

nav ul {
  margin: 0;
  padding: 0;
  list-style: none;
}

nav li {
  margin-bottom: 1.5em;
  margin-left: 1em;
}

nav a {
  color: white;
  text-decoration: none;
  text-transform: uppercase;
}

nav a:hover {
  color: #ffa98e;
}

.nav-toggle:checked ~ nav {
  display: block;
}

@media (min-width: 900px) {
  .nav-toggle-label {
    display: none;
  }
  
  header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 1rem;
    background: black;
  }
  
  nav {
    all: unset;
    display: flex;
    justify-content: space-around;
    align-items: center;
    margin-right: 1em;
  }
  
  nav ul {
    display: flex;
    align-items: center;
    gap: 1rem;
  }
  
   nav li { 
    margin-bottom: 0;
    padding: 0;
  }
}

/* Section One */

.section-one {
  margin: 11rem 2rem 0;
}

.header {
  font-size: 4.5rem;
}

.section-one-paragraph {
  margin: 2rem 0;
  width: 70%;
  max-width: 500px;
  line-height: 1.5rem;
}


.learn-more-btn {
  background: white;
  padding: 10px 20px;
  border-radius: 50px;
  font-size: .8rem;
  text-decoration: none;
  color: black;
}

.learn-more-btn:hover {
  background: #6c83ff;
  color: white;
}

/* Section Two */

/* Section Three */

.section-three h3 {
  margin: 0 auto;
  width: 80%;
  max-width: 700px;
  font-size: 2.5rem;
  font-weight: 600;
  text-align: center;
}

/* Section Four */

.flex-group {
  display: flex;
  justify-content: ;
  align-items: center;
  gap: 3rem;
}

.section-four p {
  margin-bottom: 2rem;
}

.section-four-btn {
  margin-bottom: rem;
}

/* Section Five */

.section-five-flex-group {
  flex-direction: row-reverse;
}

.section-five p {
  margin-bottom: 2rem;
}

/* Section Six */

.section-six p {
  margin-bottom: 2rem;
}

/* Flex Group Mobile */

@media (max-width: 800px) {
  .flex-group {
    flex-direction: column;
  }
}

/* Section Seven */

.section-seven h3 {
  margin: 0 auto;
  width: 80%;
  max-width: 700px;
  font-size: 2.5rem;
  font-weight: 600;
  text-align: center;
}

.section-seven-btn {
  margin: 2rem auto;
  display: flex;
  justify-content: center;
  width: 7.5rem;
}

/* Section Eight */

.section-eight h4 {
  margin: 1rem 0;
  font-size: 1.25rem;
}

.section-eight p {
  line-height: 1.5rem;
}

.section-eight img {
  
}

.flex-group-eight {
  display: flex;
  gap: 2rem;
}

@media (max-width: 800px) {
  .flex-group-eight {
    flex-direction: column;
  }
}

/* Section Nine */

.section-nine {
  margin-top: 15rem;
}

.logo-container {
  display: flex;
  gap: 1rem;
  justify-content: space-evenly;
  width: 70%;
  max-width: 700px;
  margin: 0 auto;
}

.section-nine svg {
  fill: white;
  height: 50px;
  cursor: pointer;
  transition: ease-in-out 250ms;
}

.section-nine svg:hover {
  transform: translateY(-10px);
  fill: #ffa98e;
}


/* Section Ten */

.section-ten h3 {
  margin: 15rem auto 2rem;
  width: 80%;
  max-width: 700px;
  font-size: 2.5rem;
  font-weight: 600;
  text-align: center;
}

.section-ten-btn {
  text-align: center;
  display: flex;  
  justify-content: center;
  margin: 0 auto;
  width: 7.5rem;
}

  </style>
  <body>

   <?php include 'header.php'; ?>
   
<body>
  <!--<header>-->
  <!--  <h1 class="logo">Instrument</h1>-->
  <!--  <input type="checkbox" class="nav-toggle" id="nav-toggle">-->
  <!--  <nav>-->
  <!--    <ul>-->
  <!--      <li> <a href="">What We Do</a></li>-->
  <!--      <li> <a href="">Who We Are</a></li>-->
  <!--      <li> <a href="">Being Here</a></li>-->
  <!--      <li> <a href="">Careers</a></li>-->
  <!--    </ul>-->
  <!--  </nav>-->
  <!--  <label for="nav-toggle" class="nav-toggle-label">-->
  <!--    <span></span>-->
  <!--  </label>-->
  <!--</header>-->
  
  <!-- Section One -->
  
  <section class="section-one">
    <h2 class="header">Build. Grow. Serve.</h2>
    <p class="section-one-paragraph">We are investing $3 million over the next three years Build|Grow|Serve program, created to support and empower Black underrepresented communities</p>
    <a href="" class="learn-more-btn">Learn More </a> 
  </section>
  
  <!-- Section Two -->
  <section class="section=two">
    <img src=https://images.unsplash.com/photo-1667826385031-2b4d06d686d8?crop=entropy&cs=tinysrgb&fm=jpg&ixid=MnwzMjM4NDZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2Njk2MDMyODU&ixlib=rb-4.0.3&q=80>
  </section>
  
  <!-- Section Three -->
  <section class="section-three">
    <h3>We enrich human lives through the thoughtful application of design and technology</h3>
  </section>
  
  <!-- Section Four -->
  <section class="section-four">
    <div class="flex-group">
      <div>
        <img src=https://images.unsplash.com/photo-1667490111717-21a3d34c58d0?crop=entropy&cs=tinysrgb&fm=jpg&ixid=MnwzMjM4NDZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2Njk2NzUwODU&ixlib=rb-4.0.3&q=80>
      </div>
      <div class="content-container">
        <p>In the summer of 2020, we reported our representation data and committed to doing so annually. One year later, we are please to share an update on our goals, and progress, and the work that still needs to be done.</p>
        <a href="" class="learn-more-btn section-four-btn">Learn More</a>
      </div>
    </div>
  </section>
  
  <!-- Section Five -->
  <section class="section-five">
    <div class="flex-group section-five-flex-group">
      <div>
        <img src=https://images.unsplash.com/photo-1667845210425-5f805be2f355?crop=entropy&cs=tinysrgb&fm=jpg&ixid=MnwzMjM4NDZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2Njk2NzUwODU&ixlib=rb-4.0.3&q=80>
      </div>
      <div class="content-container">
        <p>In the summer of 2020, we reported our representation data and committed to doing so annually. One year later, we are please to share an update on our goals, and progress, and the work that still needs to be done.</p>
        <a href="" class="learn-more-btn section-four-btn">Read More</a>
      </div>
    </div>
  </section>
  
  <!-- Section six -->
  <section class="section-six">
    <div class="flex-group">
      <div>
        <img src=https://images.unsplash.com/photo-1667212805718-771e5ebdd8a5?crop=entropy&cs=tinysrgb&fm=jpg&ixid=MnwzMjM4NDZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2Njk2NzYyMjg&ixlib=rb-4.0.3&q=80>
      </div>
      <div class="content-container">
        <p>In the summer of 2020, we reported our representation data and committed to doing so annually. One year later, we are please to share an update on our goals, and progress, and the work that still needs to be done.</p>
        <a href="" class="learn-more-btn section-four-btn">What We Do</a>
      </div>
    </div>
  </section>  
  
<!-- Section Seven -->  

  <section class="section-seven">
        <h3>We enrich human lives through the thoughtful application of design and technology</h3>
        <a href="" class="learn-more-btn section-seven-btn">Our Work</a>  
  </section>
  
<!-- Section Eight -->
  <section class="section-eight">
    <div class="flex-group-eight">
      <div>
        <img src=https://images.unsplash.com/photo-1667684550725-71e60ab8368e?crop=entropy&cs=tinysrgb&fm=jpg&ixid=MnwzMjM4NDZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2Njk2Nzc2NDk&ixlib=rb-4.0.3&q=80>
        <h4>Levi's</h4>
        <p>We partner with Levi's, an icon of American industry and culture, to to reimagine levi.com for a new generation of shoppers and the digital future of retail.</p>
      </div>
      
      <div>
        <img src=https://images.unsplash.com/photo-1666845267403-191d298cf198?crop=entropy&cs=tinysrgb&fm=jpg&ixid=MnwzMjM4NDZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2Njk2OTEzOTc&ixlib=rb-4.0.3&q=80>
        <h4>Dropbox Brand Campaign</h4>
        <p>Dropbox is on a path to becoming a multi-product company. To bring their customers now and old along for that journey, we helped reimagine how Dropbox engages with their audience.</p>
      </div>
    </div>
  </section>
  
  <!-- Section Nine -->
  
  <section class="section-nine">
    <div class="logo-container">
      <svg viewBox="0 0 448 512" width="100" title="address-book">
  <path d="M436 160c6.6 0 12-5.4 12-12v-40c0-6.6-5.4-12-12-12h-20V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48v416c0 26.5 21.5 48 48 48h320c26.5 0 48-21.5 48-48v-48h20c6.6 0 12-5.4 12-12v-40c0-6.6-5.4-12-12-12h-20v-64h20c6.6 0 12-5.4 12-12v-40c0-6.6-5.4-12-12-12h-20v-64h20zm-228-32c35.3 0 64 28.7 64 64s-28.7 64-64 64-64-28.7-64-64 28.7-64 64-64zm112 236.8c0 10.6-10 19.2-22.4 19.2H118.4C106 384 96 375.4 96 364.8v-19.2c0-31.8 30.1-57.6 67.2-57.6h5c12.3 5.1 25.7 8 39.8 8s27.6-2.9 39.8-8h5c37.1 0 67.2 25.8 67.2 57.6v19.2z" />
</svg>
      <svg viewBox="0 0 576 512" width="100" title="trophy">
  <path d="M552 64H448V24c0-13.3-10.7-24-24-24H152c-13.3 0-24 10.7-24 24v40H24C10.7 64 0 74.7 0 88v56c0 35.7 22.5 72.4 61.9 100.7 31.5 22.7 69.8 37.1 110 41.7C203.3 338.5 240 360 240 360v72h-48c-35.3 0-64 20.7-64 56v12c0 6.6 5.4 12 12 12h296c6.6 0 12-5.4 12-12v-12c0-35.3-28.7-56-64-56h-48v-72s36.7-21.5 68.1-73.6c40.3-4.6 78.6-19 110-41.7 39.3-28.3 61.9-65 61.9-100.7V88c0-13.3-10.7-24-24-24zM99.3 192.8C74.9 175.2 64 155.6 64 144v-16h64.2c1 32.6 5.8 61.2 12.8 86.2-15.1-5.2-29.2-12.4-41.7-21.4zM512 144c0 16.1-17.7 36.1-35.3 48.8-12.5 9-26.7 16.2-41.8 21.4 7-25 11.8-53.6 12.8-86.2H512v16z" />
</svg>
      <svg viewBox="0 0 640 512" width="100" title="warehouse">
  <path d="M504 352H136.4c-4.4 0-8 3.6-8 8l-.1 48c0 4.4 3.6 8 8 8H504c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8zm0 96H136.1c-4.4 0-8 3.6-8 8l-.1 48c0 4.4 3.6 8 8 8h368c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8zm0-192H136.6c-4.4 0-8 3.6-8 8l-.1 48c0 4.4 3.6 8 8 8H504c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8zm106.5-139L338.4 3.7a48.15 48.15 0 0 0-36.9 0L29.5 117C11.7 124.5 0 141.9 0 161.3V504c0 4.4 3.6 8 8 8h80c4.4 0 8-3.6 8-8V256c0-17.6 14.6-32 32.6-32h382.8c18 0 32.6 14.4 32.6 32v248c0 4.4 3.6 8 8 8h80c4.4 0 8-3.6 8-8V161.3c0-19.4-11.7-36.8-29.5-44.3z" />
</svg>
    </div>
  </section>
  
  <section class="section-ten">
    <h3>We'd love to be your partner</h3>
    <a href="" class="learn-more-btn section-ten-btn">Get In Touch</a>
  </section>
  
</body>

    <?php include 'footer.php'; ?>

    <script src="js/vendor/jquery.js"></script>
    <!-- <script src="js/foundation.min.js"></script> -->
    <!-- <script>
      $(document).foundation();
    </script> -->
  </body>
</html>
