<?php
if (session_id() == '' || !isset($_SESSION)) {
    session_start();
}

include 'config.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$user_id = $_SESSION['user_id'] ?? null;

if ($user_id) {
    // Fetch existing user data from the database
    $sql = "SELECT fname, lname, address, city, pin, email FROM users WHERE id=?";
    $stmt = $mysqli->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($fname, $lname, $address, $city, $pin, $email);
        $stmt->fetch();
        $stmt->close();
    } else {
        die("Error preparing statement: " . $mysqli->error);
    }

    // Update the database if form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
        $fname = $_POST["fname"] ?? '';
        $lname = $_POST["lname"] ?? '';
        $address = $_POST["address"] ?? '';
        $city = $_POST["city"] ?? '';
        $pin = $_POST["pin"] ?? '';
        $email = $_POST["email"] ?? '';

        if (!empty($fname) && !empty($lname) && !empty($address) && !empty($city) && !empty($pin) && !empty($email)) {
            $sql = "UPDATE users SET fname=?, lname=?, address=?, city=?, pin=?, email=? WHERE id=?";
            $stmt = $mysqli->prepare($sql);
            if ($stmt) {
                $stmt->bind_param("ssssssi", $fname, $lname, $address, $city, $pin, $email, $user_id);
                
                if ($stmt->execute()) {
                    echo "Record updated successfully";
                } else {
                    echo "Error updating record: " . $stmt->error;
                }

                $stmt->close();
            } else {
                die("Error preparing statement: " . $mysqli->error);
            }
        }
    }

    $mysqli->close();
} else {
    die("User ID is not set in the session.");
}
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Account || Style BAZAAR</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
</head>
<body>

<?php include 'header.php'; ?>

<div class="row" style="margin-top:30px;">
    <div class="small-12">
        <p><h4>Account Details</h4></p>
        <p>Below are your details in the database. If you wish to change anything, then just enter new data in text box and click on update.</p>
    </div>
</div>

<form method="POST" action="" style="margin-top:30px;">
    <div class="row">
        <div class="small-8">
          <div class="row">
            <div class="small-4 columns">
              <label for="fname" class="right inline">First Name</label>
            </div>
            <div class="small-8 columns">
              <input type="text" id="fname" value="<?php echo htmlspecialchars($fname); ?>" name="fname" required>
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
              <label for="lname" class="right inline">Last Name</label>
            </div>
            <div class="small-8 columns">
              <input type="text" id="lname" value="<?php echo htmlspecialchars($lname); ?>" name="lname" required>
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
              <label for="address" class="right inline">Address</label>
            </div>
            <div class="small-8 columns">
              <input type="text" id="address" value="<?php echo htmlspecialchars($address); ?>" name="address" required>
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
              <label for="city" class="right inline">City</label>
            </div>
            <div class="small-8 columns">
              <input type="text" id="city" value="<?php echo htmlspecialchars($city); ?>" name="city" required>
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
              <label for="pin" class="right inline">Pin Code</label>
            </div>
            <div class="small-8 columns">
              <input type="number" id="pin" value="<?php echo htmlspecialchars($pin); ?>" name="pin" required>
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
              <label for="email" class="right inline">E-Mail</label>
            </div>
            <div class="small-8 columns">
              <input type="email" id="email" value="<?php echo htmlspecialchars($email); ?>" name="email" required>
            </div>
          </div>

          <div class="row">
            <div class="small-4 columns">
            </div>
            <div class="small-8 columns">
              <input type="submit" name="update" value="Update" style="background: #0078A0; border: none; color: #fff; font-family: 'Helvetica Neue', sans-serif; font-size: 1em; padding: 10px;">
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
