<?php   
include 'payment.html';
include '../connect.php';
?>

<html>
<head>
    <title>Delete Payment</title>
</head>
<body>
    <h1>Delete Payment</h1>
    <form action="delete_payment.php" method="get">
        Payment to Delete: 
        <select name="Invoice_No" id="Invoice_No" required>
            <option value="">Please Choose</option>
            <?php 
            $sql = "SELECT Invoice_No FROM payment";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='{$row['Invoice_No']}'>{$row['Invoice_No']}</option>";
              }
            }
            ?>
    </select><br><br>
    <input type="submit" value="Delete Payment">
    </form> 
</body>
</html>

<?php
include '../connect.php';

if(isset($_GET['Invoice_No'])) {
    $invoice_no = $_GET['Invoice_No'];
    
    $sql1 = "SELECT * FROM Card WHERE Invoice_No = '$invoice_no'";
    $result1 = mysqli_query($conn, $sql1);
    if (mysqli_num_rows($result1) > 0) {
        $payment_method = 'Card';
    } else {
        $sql2 = "SELECT * FROM Cash WHERE Invoice_No = '$invoice_no'";
        $result2 = mysqli_query($conn, $sql2);
        if (mysqli_num_rows($result2) > 0) {
            $payment_method = 'Cash';
        } else {
            $payment_method = 'Online';
        }
    }

        if ($payment_method == 'Cash') {
        $sql = "DELETE FROM Cash WHERE Invoice_No = '$invoice_no'";
        mysqli_query($conn, $sql);
    } elseif ($payment_method == 'Card') {
        $sql = "DELETE FROM Card WHERE Invoice_No = '$invoice_no'";
        mysqli_query($conn, $sql);
    } elseif ($payment_method == 'Online') {
        $sql = "DELETE FROM Online WHERE Invoice_No = '$invoice_no'";
        mysqli_query($conn, $sql);
    }

    $sql3 = "DELETE FROM payment WHERE Invoice_No = '$invoice_no'";
    $result = mysqli_query($conn, $sql3);

    if($result) {   
    if ($conn->query($sql3) ==TRUE ) {
        echo $invoice_no . " Payment is deleted successfully";
    } else {
        echo "No record found for Invoice_No: " . $invoice_no;
    }
    } else {
        echo "No invoice number provided.";
    }

}
mysqli_close($conn);
?>