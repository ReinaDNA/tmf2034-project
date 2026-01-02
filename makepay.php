<?php
include 'connect.php';
include 'payment.php';

# Detect which payment type is chosen

$payType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['Pay_Type'])) {
        $payType = $_POST['Pay_Type'];
    }

    if (isset($_POST['Confirm_Membership'])) {
        $invoiceNo = 'INV' . date('Ymd') . rand(1000, 9999);
        $member_id = $_POST['Member_ID'];
        
        // Get Membership ID
        $sql = "SELECT Membership_ID FROM Membership WHERE Member_ID = '$member_id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $membership_id = $row['Membership_ID'];

        $payment_method = $_POST['Payment_Method'];

        $sql = "INSERT INTO Payment
            (Invoice_No, Member_ID, Membership_ID, Program_ID,
            Payment_Date, Amount, Payment_Type)
            VALUES
            ('$invoiceNo', '$member_id', '$membership_id', '',
            NOW(), 0, '$payment_method')";

    echo "<h3>Membership Payment Submitted</h3>";
    }

    if (isset($_POST['Confirm_Program'])) {

        $invoiceNo = 'INV' . date('Ymd') . rand(1000, 9999);
        $member_id = $_POST['Member_ID'];

        // Get Membership ID
        $sql = "SELECT Membership_ID FROM Membership WHERE Member_ID = '$member_id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $membership_id = $row['Membership_ID'];

        $program_id = $_POST['Program_ID'];
        $payment_method = $_POST['Payment_Method'];

        // Insert payment
        $sql = "INSERT INTO Payment
                (Invoice_No, Member_ID, Membership_ID, Program_ID,
                Payment_Date, Amount, Payment_Type)
                VALUES
                ('$invoiceNo', '$member_id', '$membership_id', '$program_id',
                NOW(), 0, '$payment_method')";

        mysqli_query($conn, $sql);

        echo "<h3>Program Payment Submitted</h3>";
        echo "Invoice No: <strong>$invoiceNo</strong>";
    }

}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Make Payment</title>
</head>
<body>

<h1>Make Payment</h1>

<form method="post" action="makepay.php">

    <h2>Payment for?</h2>
    <input type="submit" name="Pay_Type" value="Membership">
    <input type="submit" name="Pay_Type" value="Program">

    <!--Membership-->
    <?php if ($payType === 'Membership'): ?>

        <hr>
        <h2>Membership Payment</h2>

        Member ID:
        <input type="text" name="Member_ID" required><br><br>
        
        Membership Type:<br>
        <input type="radio" name="Membership_Type" value="Monthly" required> Monthly
        <input type="radio" name="Membership_Type" value="Quarterly"> Quarterly
        <input type="radio" name="Membership_Type" value="Annually"> Annually
        <br><br>

        Pay via:
        <select name="Payment_Method" required>
            <option value="" disabled selected>Please Choose</option>
            <option value="Cash">Cash</option>
            <option value="Card">Card</option>
            <option value="Online">E-wallet</option>
        </select><br><br>

        <input type="submit" name="Confirm_Membership" value="Confirm Membership Payment">

    <?php endif; ?>

    <!--Program-->
    <?php if ($payType === 'Program'): ?>

        <hr>
        <h2>Program Payment</h2>

        Member ID:
        <input type="text" name="Member_ID" required><br><br>

        Program Category:
        <select name="Program_Category" required>
            <option value="" disabled selected>Please Choose</option>
            <option value="Yoga">Yoga</option>
            <option value="Fitness">Fitness</option>
            <option value="Nutrition">Nutrition</option>
            <option value="Physiotherapy">Physiotherapy</option>
        </select><br><br>

        Program ID:
        <php if (isset($_POST['Program_Category'])): ?>
            <select name="Program_ID" required>
                <option value="" disabled selected>Please Choose</option>
                <?php
                $category = $_POST['Program_Category'];
                $sql = "SELECT Program_ID, Program_Name FROM Program WHERE Program_Category = '$category'";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['Program_ID'] . "'>" . $row['Program_Name'] . "</option>";
                }
                ?>
            </select><br><br>

        Pay via:
        <select name="Payment_Method" required>
            <option value="" disabled selected>Please Choose</option>
            <option value="Cash">Cash</option>
            <option value="Card">Card</option>
            <option value="Online">E-wallet</option>
        </select><br><br>

        <php if (isset($_POST['Payment_Method'])): ?>
            $payment_method = $_POST['Payment_Method'];

            if ($payment_method == 'Card') {
                echo 'Card Number: <input type="text" name="Card_Number" required><br><br>';
                echo 'Card_Type:
                <input type="radio" name="Card_Type" value="Visa" required> Visa
                <input type="radio" name="Card_Type" value="MasterCard"> MasterCard
                echo 'Expiry Date: <input type="month" name="Last4Digit" required><br><br>';
                echo 'Card Bank:
                <option value="" disabled selected>Please Choose</option>
                <option value="CIMB">CIMB</option>
                <option value="Maybank">Maybank</option>    
                <option value="Public Bank">Public Bank</option>
                <option value="RHB">RHB</option>
                <select><br><br>';

            } elseif ($payment_method == 'Ewallet') {
                echo 'Payment Provider: 
                <option value="" disabled selected>Please Choose</option>
                <option value="Touch n Go">Touch n Go</option>
                <option value="Grab Pay">Grab Pay</option>
                <option value="Boost">Boost</option>
                <option value="Shopee Pay">Shopee Pay</option>
                <select><br><br>';
            }

        <input type="submit" name="Confirm_Program" value="Confirm Program Payment">

    <?php endif; ?>

</form>

</body>
</html>
