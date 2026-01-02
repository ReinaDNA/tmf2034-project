 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
 </head>

 <body>
     <h1>Payments Page</h1>
     <p>
        This page is for making payments and checking payment history made at Fitlife Wellness Centre.
     </p>
        <a href="../../main.html">Home</a>
        <a href="../add_payment.php">Make Payment</a>
        <a href="../view_payment_record.php">Payment History</a>
        <a href="../delete_payment.php">Delete Payment</a>
    <hr>
</body>
</html>

<?php
include '../../connect.php';

$Invoice_No    = '';
$Cash_Received = '';

if (isset($_GET['Invoice_No'])) {
    $Invoice_No = $_GET['Invoice_No'];
    $sql = "SELECT * FROM card WHERE Invoice_No = '$Invoice_No'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $sql2 = "SELECT Amount FROM payment WHERE Invoice_No = '$Invoice_No'";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($result2);

    if ($row) {
        $Invoice_No = $row['Invoice_No'];
        $Cash_Received = $row['Cash_Received'];
        $Cash_Changed = $row['Cash_Changed'];
    } 
    if ($row2) {
        $Amount = $row2['Amount'];

    } else {
        echo "No payment found with ID: " . $Invoice_No;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Invoice_No = $_POST['Invoice_No'];
    $Cash_Received = $_POST['Cash_Received'];

    $sql = "SELECT Amount FROM payment WHERE Invoice_No = '$Invoice_No'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $Amount = $row['Amount'];

    $Cash_Changed = $Cash_Received - $Amount;

    $sql2 = "UPDATE Cash SET 
            Cash_Received = '$Cash_Received',
            Cash_Changed = '$Cash_Changed'
            WHERE Invoice_No = '$Invoice_No'";
    
    if (mysqli_query($conn, $sql2)) {
        echo "Cash Payment updated successfully.<br>";
    } else {
        echo "Error updating payment: " . mysqli_error($conn);
    }   
    
}
?>

<html>
<head>
    <title>Update Payment Information</title>
</head>
<body>
    <p1>Update Payment Information Form For : <?php echo "(Invoice No: " . $Invoice_No . ")"; ?></p1>
    <form action="update_cash_payment_form.php" method="post">
        <input type="hidden" name="Invoice_No" value="<?php echo $Invoice_No; ?>">
        <?php echo "Amount to Pay: RM" . number_format($Amount, 2); ?><br><br>
        Cash Received: <input type="number" step="0.01" name="Cash_Received" value="<?php echo $Cash_Received; ?>"><br><br>

        <input type="submit" value="Update Payment">
    </form>
</body>
</html>

<?php
mysqli_close($conn);
?>
