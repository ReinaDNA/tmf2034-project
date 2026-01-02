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
$Payment_Provider = '';
$Transaction_ID = '';

if (isset($_GET['Invoice_No'])) {
    $Invoice_No = $_GET['Invoice_No'];
    $sql = "SELECT * FROM card WHERE Invoice_No = '$Invoice_No'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $Invoice_No = $row['Invoice_No'];
        $Payment_Provider = $row['Payment_Provider'];
        $Transaction_ID = $row['Transaction_ID'];

    } else {
        echo "No payment found with ID: " . $Invoice_No;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Invoice_No = $_POST['Invoice_No'];
    $Payment_Provider = $_POST['Payment_Provider'];
    $Transaction_ID = $_POST['Transaction_ID'];
    
    $sql = "UPDATE online SET 
            Payment_Provider = '$Payment_Provider',
            Transaction_ID = '$Transaction_ID'
            WHERE Invoice_No = '$Invoice_No'";
    
    if (mysqli_query($conn, $sql)) {
        echo "Online Payment updated successfully.<br>";
    } else {
        echo "Error updating payment: " . mysqli_error($conn);
    }   
    
}
?>

<html>
<head>
    <title>Update Online Payment Information</title>
</head>
<body>
    <p1>Update Online Payment Information Form For : <?php echo "(Invoice No: " . $Invoice_No . ")"; ?></p1>
    <form action="update_online_payment_form.php" method="post">
        <input type="hidden" name="Invoice_No" value="<?php echo $Invoice_No; ?>">
        Payment Provider:
        <select name="Payment_Provider" require>
            <option valjue="">Please Choose</option>
            <option value="TouchNGo" <?php if ($Payment_Provider == "TouchNGo") echo "selected"; ?>>TouchNGo</option>
            <option value="GrabPay" <?php if ($Payment_Provider == "GrabPay") echo "selected"; ?>>GrabPay</option>
            <option value="ShopeePay" <?php if ($Payment_Provider == "ShopeePay") echo "selected"; ?>>ShopeePay</option>
        </select><br><br>

        Transaction ID: <input type="text" name="Transaction_ID" value="<?php echo $Transaction_ID; ?>"><br><br>
        <input type="submit" value="Update Payment">
    </form>
</body>
</html>

<?php
mysqli_close($conn);
?>
