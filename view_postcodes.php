<?php   
include 'postcode.html';
?>
<html>
<head>
    <title>View Postcodes</title>     
</head>
<body>
    <h1>Postcodes List</h1> 
    <table border="1" width="100%" cellpadding="10" cellspacing="0">
        <tr>
            <th>Postcode</th>
            <th>City</th>
            <th>State</th>
        </tr>
      
<?php
include 'connect.php';

$sql = "SELECT * FROM postcode";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $postcode = $row['Postcode'];
        echo "<tr>";
        echo "<td>{$row['Postcode']}</td>";
        echo "<td>{$row['City']}</td>";
        echo "<td>{$row['State']}</td>";
        echo "<td><a href='update_postcode_form.php?postcode=".$postcode."'>Update</a></td>";
        echo "</tr>";
    }
} else {
    echo "0 results";
}       

mysqli_close($conn);
?>