<?php
include 'payment.html';
include '../connect.php';

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
