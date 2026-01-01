<?php   
include 'program.html';
?>
<html>
<head>
    <title>Add Program</title>
</head>
<body>
    <form action ="add_program.php" method="post">
        <h1>Add New Program</h1>

        Program ID: <input type="text" name = "Program_ID" required><br><br>

        Program Name: <input type="text" name = "Program_Name" required><br><br>

        Program Duration: 
        <select name="Program_Duration" id="Program_Duration" required>
        <option value ="">Please Choose</option>
        <option value="1 Week">1 Week</option>
        <option value="2 Weeks">2 Weeks</option>
        <option value="3 Weeks">3 Weeks</option>
        <option value="4 Weeks">4 Weeks</option>
        <option value="5 Weeks">5 Weeks</option>
        <option value="6 Weeks">6 Weeks</option>
        <option value="7 Weeks">7 Weeks</option>
        <option value="8 Weeks">8 Weeks</option>
        <option value="9 Weeks">9 Weeks</option>
        <option value="10 Weeks">10 Weeks</option> 
        <br><br>
        </select><br><br>

        Program Category: 
        <select name="Program_Category" id="Program_Category" required>
        <option value ="">Please Choose</option>
        <option value="Yoga">Yoga</option>
        <option value="Fitness">Fitness</option>
        <option value="Nutrition">Nutrition</option>
        <option value="Physiotherapy">Physiotherapy</option><br><br>
        </select><br><br>

        Program Fee: <input type="number" name="Program_Fee" step="0.01" min="0" max="99999.99" required><br><br>
        
        <input type="submit" value="Add Program">    
    </form>
</body>
</html>

<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $program_id = $_POST['Program_ID'];
    $program_name = $_POST['Program_Name'];
    $program_category = $_POST['Program_Category'];
    $program_duration = $_POST['Program_Duration'];
    $program_fee = $_POST['Program_Fee'];

    $sql = "INSERT INTO Program
            (Program_ID, Program_Name, Program_Category, Program_Duration, Program_Fee)
            VALUES
            ('$program_id', '$program_name', '$program_category', '$program_duration', '$program_fee')";

    if ($conn->query($sql) === TRUE) {
        echo "New program added successfully.";
    } else {
        echo "Error adding program: " . $conn->error;
    }
}