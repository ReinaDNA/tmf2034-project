<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fitlife_wellness_centre_database_system"; // any database you want to use

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST["trainer_id"])) {
    $sql = "INSERT INTO postcode (postcode, city, state)
            VALUES ('" .  $_POST["postcode"]. "', '" . $_POST["city"] . "', '" . $_POST["state"] . "')";
    $sql2 = "INSERT INTO Trainer (Trainer_ID, Trainer_FName, Trainer_LName, Trainer_Contact, Trainer_Email,
            Trainer_Gender, Trainer_Specialization, Trainer_Certification, Door, Street, Postcode)
            VALUES ('" . $_POST["trainer_id"] . "', '" . $_POST["fname"] . "', '" . $_POST["lname"] . "', '" . $_POST["contact"] . "', '" . $_POST["email"] . "', '" . $_POST["gender"] . "', '" . $_POST["specialization"] . "', '" . $_POST["cert"] . "', '" . $_POST["door"] . "', '" . $_POST["street"] . "', '" . $_POST["postcode"] . "')";

    if (mysqli_query($conn, $sql) && mysqli_query($conn, $sql2)) {
        echo "New trainer record created successfully";
        include 'add_trainer_form.php';
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn) . "<br>" . $sql2 . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<html>
  <body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
      Trainer Details: <br>
      ========================= <br>
      Trainer ID: <input type="text" name="trainer_id" required><br><br>
      Trainer First Name: <input type="text" name="fname" required><br><br>
      Trainer Last Name: <input type="text" name="lname" required><br><br>
      Trainer Contact: <input type="text" name="contact" required><br><br>
      Trainer Email: <input type="text" name="email" required><br><br>
      Trainer Gender: <input type="text" name="gender"><br><br>
      Trainer Specialization: <input type="text" name="specialization"><br><br>
      Trainer Certificate: <input type="text" name="cert"><br><br>
      Door Number: <input type="text" name="door"><br><br>
      Street: <input type="text" name="street"><br><br>
      Postcode: <input type="text" name="postcode"><br><br>
      City: <input type="text" name="city"><br><br>
      State: <input type="text" name="_state"><br><br>
      <input type="submit">
    </form>
  </body>
</html>