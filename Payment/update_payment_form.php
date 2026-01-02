<?php
include 'payment.html';
include '../connect.php';

$Invoice_No    = '';
$Member_ID     = '';
$Membership_ID = '';
$Program_ID    = '';
$Payment_Date  = '';
$Amount        = '';
$Payment_Type  = '';

if (isset($_GET['Invoice_No'])) {
    $Invoice_No = $_GET['Invoice_No'];
    $sql = "SELECT * FROM payment WHERE Invoice_No = '$Invoice_No'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $Invoice_No = $row['Invoice_No'];
        $Member_ID = $row['Member_ID'];
        $Membership_ID = $row['Membership_ID'];
        $Program_ID = $row['Program_ID'];
        $Payment_Date = $row['Payment_Date'];
        $Amount = $row['Amount'];
        $Payment_Type = $row['Payment_Type'];

    } else {
        echo "No payment found with ID: " . $Invoice_No;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Invoice_No = $_POST['Invoice_No'];
    $Payment_Date = $_POST['Payment_Date'];
    
    $sql = "UPDATE payment SET 
            Payment_Date = '$Payment_Date'
            WHERE Invoice_No = '$Invoice_No'";
    
    if (mysqli_query($conn, $sql)) {
        echo "Payment updated successfully.<br>";
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
    <form action="update_payment_form.php" method="post">
        <input type="hidden" name="Invoice_No" value="<?php echo $Invoice_No; ?>">
        Payment Date: <input type="date" name = "Payment_Date" value="<?php echo $Payment_Date; ?>"><br><br>
        
        <input type="submit" value="Update Payment">
    </form>
</body>
</html>

<?php
mysqli_close($conn);
?>