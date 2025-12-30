<html>
<body>
    <form action ="add_member.php" method="get">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required><br><br>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required><br><br>

        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" required><br><br>

        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phone" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label>Gender:</label>
        <input type="radio" id="male" name="gender" value="male" required>
        <label for="male">Male</label>
        <input type="radio" id="female" name="gender" value="female">
        <label for="female">Female</label><br><br>

        <label>Address:</label><br>
        <label for="unit_number">Sublot:</label>
        <input type="text" id="unit_number" name="unit_number" required><br>
        <label for="address">Street Name:</label>
        <input type="text" id="address" name="address" required><br>
        <label for="postal_code">Postal Code:</label>
        <input type="text" id="postal_code" name="postal_code" required><br>

        <br><input type="submit" value="Add Member">
    </form>
</body>
</html>

<?php  
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fitlife_wellness_centre_database_system"; // Connect to database name

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $first_name = $_GET['first_name'];
    $last_name = $_GET['last_name'];
    $dob = $_GET['dob'];
    $phone = $_GET['phone'];
    $email = $_GET['email'];
    $gender = $_GET['gender'];
    $unit_number = $_GET['unit_number'];    
    $address = $_GET['address'];
    $postal_code = $_GET['postal_code'];
    
    $sql = "INSERT INTO members 
            (first_name, last_name, dob, phone, email, gender, unit_number, address, postal_code) 
            VALUES 
            ('$first_name', '$last_name', '$dob', '$phone', '$email', '$gender', '$unit_number', '$address', '$postal_code')";    

    if ($conn->query($sql) === TRUE) {
        echo "New member added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

}
?>