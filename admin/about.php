<?php

include 'header.php';
?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Panel || Edit About Us || Style BAZAAR</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
  </head>
  <body>
    <div class="row" style="margin-top:30px;">
      <div class="small-12">
        <h2>Admin Panel - Edit About Us</h2>

        <!-- Form to update the About section -->
        <form action="admin_about.php" method="post">
          <label for="history">History:</label>
          <textarea id="history" name="history" rows="4" cols="50"></textarea>

          <label for="years_experience">Years of Experience:</label>
          <input type="number" id="years_experience" name="years_experience">

          <label for="projects_completed">Projects Completed:</label>
          <input type="number" id="projects_completed" name="projects_completed">

          <label for="work_awards">Best Work Awards:</label>
          <input type="number" id="work_awards" name="work_awards">

          <input type="submit" name="submit" value="Update">
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle the form submission and update the content
            $history = $_POST['history'];
            $years_experience = $_POST['years_experience'];
            $projects_completed = $_POST['projects_completed'];
            $work_awards = $_POST['work_awards'];

            // Here, you would typically save this data to a database.
            // For demonstration purposes, we'll just output it.
            echo "<h3>Updated Content</h3>";
            echo "<p>History: $history</p>";
            echo "<p>Years of Experience: $years_experience</p>";
            echo "<p>Projects Completed: $projects_completed</p>";
            echo "<p>Best Work Awards: $work_awards</p>";
        }
        ?>
      </div>
    </div>

    <?php include 'footer.php'; ?>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
  </body>
</html>
