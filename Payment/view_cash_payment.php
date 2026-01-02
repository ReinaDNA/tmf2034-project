<?php   
include 'payment.html';
?>
<htmL>
<head>
    <title>View Cash Payment Records</title>     
</head>
<body>
    <h1>Cash Payment Records List</h1> 
    <table border="1" width="100%" cellpadding="10" cellspacing="0">
        <tr>
            <th>Invoice No</th>
            <th>Cash Received</th>
            <th>Cash Changed</th>
            <th>Amount Paid</th>
            <th>Action</th>
        </tr>
      
<?php
include '../connect.php';

$sql = "SELECT * FROM cash;";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $Invoice_No = $row['Invoice_No'];
        $sql2 = "SELECT Amount FROM payment WHERE Invoice_No = '$Invoice_No';";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        
        echo "<tr>";
        echo "<td>{$row['Invoice_No']}</td>";
        echo "<td>{$row['Cash_Received']}</td>";
        echo "<td>{$row['Cash_Changed']}</td>";
        echo "<td>RM{$row2['Amount']}</td>";
        echo "<td><a href='update_cash_payment_form.php?Invoice_No=".$Invoice_No."'>Update</a></td>";
        echo "</tr>";
    }
} else {
    echo "0 results";
}       

mysqli_close($conn);
?>
<input type="button" value="Back" onclick="window.location.href='view_payment_record.php'"><br><br>