<?php   
include 'program.html';
?>
<htmL>
<head>
    <title>View Programs</title>     
</head>
<body>
    <h1>Program List</h1> 
    <table border="1" width="100%" cellpadding="10" cellspacing="0">
        <tr>
            <th>Program ID</th>
            <th>Program Name</th>
            <th>Program Duration</th>
            <th>Program Category</th>
            <th>Program Fee</th>
        </tr>
      
<?php
include '../connect.php';

$sql = "SELECT * FROM program";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $id = $row['Program_ID'];
        echo "<tr>";
        echo "<td>{$row['Program_ID']}</td>";
        echo "<td>{$row['Program_Name']}</td>";
        echo "<td>{$row['Program_Duration']}</td>";
        echo "<td>{$row['Program_Category']}</td>";
        echo "<td>RM{$row['Program_Fee']}</td>";
        echo "<td><a href='update_program_form.php?id=".$id."'>Update</a></td>";
        echo "</tr>";
    }
} else {
    echo "0 results";
}       

mysqli_close($conn);
?>