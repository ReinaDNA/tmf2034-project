<?php   
include 'enrolment.html';
?>
<htmL>
<head>
    <title>View Enrolments</title>     
</head>
<body>
    <h1>Enrolments List</h1> 
    <table border="1" width="100%" cellpadding="10" cellspacing="0">
        <tr>
            <th>Member ID</th>
            <th>Program ID</th>
            <th>Enrolment Date</th>  
        </tr>
      
<?php
include '../connect.php';

$sql = "SELECT * FROM enrolment";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $id = $row['Member_ID'];
        echo "<tr>";
        echo "<td>{$row['Member_ID']}</td>";
        echo "<td>{$row['Program_ID']}</td>";
        echo "<td>{$row['Enrolment_Date']}</td>";
        echo "<td><a href='update_enrolment_form.php?member_id=".$row['Member_ID']."&program_id=".$row['Program_ID']."'>Update</a></td>";
        echo "</tr>";
    }
} else {
    echo "0 results";
}       

mysqli_close($conn);
?>