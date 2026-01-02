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
$Card_Type     = '';
$Card_Last4Digit = '';
$Card_Bank     = '';

if (isset($_GET['Invoice_No'])) {
    $Invoice_No = $_GET['Invoice_No'];
    $sql = "SELECT * FROM card WHERE Invoice_No = '$Invoice_No'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $Invoice_No = $row['Invoice_No'];
        $Card_Type = $row['Card_Type'];
        $Card_Last4Digit = $row['Card_Last4Digit'];
        $Card_Bank = $row['Card_Bank'];

    } else {
        echo "No payment found with ID: " . $Invoice_No;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Invoice_No = $_POST['Invoice_No'];
    $Card_Type = $_POST['Card_Type'];
    $Card_Last4Digit = $_POST['Card_Last4Digit'];
    $Card_Bank = $_POST['Card_Bank'];
    
    $sql = "UPDATE card SET 
            Card_Type = '$Card_Type',
            Card_Last4Digit = '$Card_Last4Digit',
            Card_Bank = '$Card_Bank'
            WHERE Invoice_No = '$Invoice_No'";
    
    if (mysqli_query($conn, $sql)) {
        echo "Card Payment updated successfully.<br>";
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
    <form action="update_card_payment_form.php" method="post">
        <input type="hidden" name="Invoice_No" value="<?php echo $Invoice_No; ?>">
        Card Type: 
        <select name="Card_Type" require>
            <option valjue="">Please Choose</option>
            <option value="Visa" <?php if ($Card_Type == "Visa") echo "selected"; ?>>Visa</option>
            <option value="MasterCard" <?php if ($Card_Type == "MasterCard") echo "selected"; ?>>MasterCard</option>
        </select><br><br>

        Card Last 4 Digits: <input type="text" name="Card_Last4Digit" value="<?php echo $Card_Last4Digit; ?>"><br><br>

        Card Bank: <input type="text" name="Card_Bank" value="<?php echo $Card_Bank; ?>"><br><br>
        <input type="submit" value="Update Payment">
    </form>
</body>
</html>

<?php
mysqli_close($conn);
?>
