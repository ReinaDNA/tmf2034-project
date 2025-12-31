<?php   
include 'member.html';
?>
<htmL>
<head>
    <title>View Members</title>     
</head>
<body>
    <h1>Members List</h1> 
    <table border="1" width="100%" cellpadding="10" cellspacing="0">
        <tr>
            <th>Member ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Date of Birth</th>
            <th>Contact Number</th>
            <th>Email</th>
            <th>Gender</th>
            <th>Address</th>    
        </tr>
      
<?php
include 'connect.php';

$sql = "SELECT * FROM member";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $id = $row['Member_ID'];
        echo "<tr>";
        echo "<td>{$row['Member_ID']}</td>";
        echo "<td>{$row['Member_FName']}</td>";
        echo "<td>{$row['Member_LName']}</td>";
        echo "<td>{$row['Member_DOB']}</td>";
        echo "<td>{$row['Member_Contact']}</td>";
        echo "<td>{$row['Member_Email']}</td>";
        echo "<td>{$row['Member_Gender']}</td>";
        echo "<td>{$row['Door']}, {$row['Street']}, {$row['Postcode']}</td>";
        echo "<td><a href='update_member_form.php?id=".$id."'>Update</a></td>";
        echo "</tr>";
    }
} else {
    echo "0 results";
}       

mysqli_close($conn);
?>
