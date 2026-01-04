<?php
include 'payment.html';
include '../connect.php';

$step = $_POST['step'] ?? 1;
$Invoice_No     = $_POST['Invoice_No']     ?? '';
$Member_ID      = $_POST['Member_ID']      ?? '';
$Payment_Date   = $_POST['Payment_Date']   ?? '';
$Amount         = $_POST['Amount']         ?? '';
$Payment_Type   = $_POST['Payment_Type']   ?? '';
$Membership_ID  = $_POST['Membership_ID']  ?? '';
$Program_ID     = $_POST['Program_ID']     ?? '';
$Payment_Method = $_POST['Payment_Method'] ?? '';
$Cash_Received  = $_POST['Cash_Received']  ?? '';
?>


<html>
<head>
    <title>Add Payment</title>
</head>
<body>
<h1>Add Payment</h1>

<?php if ($step == 1) { ?>
<form method="post">
    <input type="hidden" name="step" value="2">

    Invoice No:
    <input type="text" name="Invoice_No" required><br><br>

    Member ID:
    <select name="Member_ID" required>
        <option value="">Choose Member</option>
        <?php
        $result_member = mysqli_query($conn, "SELECT Member_ID FROM Member");
        while ($r1 = mysqli_fetch_assoc($result_member)) {
            echo "<option value='{$r1['Member_ID']}'>{$r1['Member_ID']}</option>";
        }
        ?>
    </select><br><br>

    Payment Date:
    <input type="date" name="Payment_Date" required><br><br>

    <input type="submit" value="Next">
</form>
<?php } ?>

<?php if ($step == 2) { ?>
<form method="post">
    <input type="hidden" name="step" value="3">
    <input type="hidden" name="Invoice_No" value="<?php echo $Invoice_No; ?>">
    <input type="hidden" name="Member_ID" value="<?php echo $Member_ID; ?>">
    <input type="hidden" name="Payment_Date" value="<?php echo $Payment_Date; ?>">

    Payment For:<br>
    <input type="radio" name="Payment_Type" value="Membership" required> Membership<br>
    <input type="radio" name="Payment_Type" value="Program" required> Program<br><br>

    <input type="submit" value="Next">
</form>
<?php } ?>

<?php if ($step == 3) { ?> 
<form method="post">
    <input type="hidden" name="step" value="4">
    <input type="hidden" name="Invoice_No" value="<?php echo $Invoice_No; ?>">
    <input type="hidden" name="Member_ID" value="<?php echo $Member_ID; ?>">
    <input type="hidden" name="Payment_Date" value="<?php echo $Payment_Date; ?>">
    <input type="hidden" name="Payment_Type" value="<?php echo $Payment_Type; ?>">

    <?php if ($Payment_Type == 'Membership') { ?> 
        Membership:
        <select name="Membership_ID" required>
            <?php
            $res = mysqli_query($conn, "SELECT Membership_ID FROM Membership WHERE Member_ID='$Member_ID'");
            while ($r = mysqli_fetch_assoc($res)) {
                echo "<option value='{$r['Membership_ID']}'>{$r['Membership_ID']}</option>";
            }
            ?>
        </select>
        
    <?php } elseif($Payment_Type == 'Program') { ?>
        Program:
        <select name="Program_ID" required>
            <?php
            $res = mysqli_query($conn, "SELECT Program_ID FROM Enrolment WHERE Member_ID='$Member_ID'");
            while ($r = mysqli_fetch_assoc($res)) {
                echo "<option value='{$r['Program_ID']}'>{$r['Program_ID']}</option>";
            }
            ?>
        </select>
    <?php } ?>

    <br><br>
    <input type="submit" value="Next">
</form>
<?php } ?>

<?php if ($step == 4) { ?>

    <?php if ($Payment_Type == 'Membership') { ?>
        <input type="hidden" name="Membership_ID" value="<?php echo $Membership_ID; ?>">
    <?php
        $sql = "SELECT Membership_Type FROM Membership WHERE Membership_ID = '$Membership_ID'";
        $result = mysqli_query($conn, $sql); 
        $row = mysqli_fetch_assoc($result);
        $res= $row['Membership_Type'];
        if ($res == 'Annually') {
            $Amount = 1200;
        }elseif ($res == 'Quarterly') {
            $Amount = 300;
        }elseif ($res == 'Monthly') {
            $Amount = 100;
        }  
    ?>
    <?php } elseif ($Payment_Type == 'Program') { ?>
        <input type="hidden" name="Program_ID" value="<?php echo $Program_ID; ?>">
        <?php
            $sql = "SELECT Program_Fee FROM Program WHERE Program_ID = '$Program_ID'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $Amount = $row['Program_Fee'];
        ?>
    <?php } ?>

<form method="post">
    <input type="hidden" name="step" value="5">
    <input type="hidden" name="Invoice_No" value="<?php echo $Invoice_No; ?>">
    <input type="hidden" name="Member_ID" value="<?php echo $Member_ID; ?>">
    <input type="hidden" name="Payment_Date" value="<?php echo $Payment_Date; ?>">
    <input type="hidden" name="Payment_Type" value="<?php echo $Payment_Type; ?>">
    <input type="hidden" name="Amount" value="<?php echo $Amount; ?>">
    <?php if ($Payment_Type == 'Membership') { ?>
        <input type="hidden" name="Membership_ID" value="<?php echo $Membership_ID; ?>">
    <?php } elseif ($Payment_Type == 'Program') { ?>
        <input type="hidden" name="Program_ID" value="<?php echo $Program_ID; ?>">
    <?php } ?>

    <?php echo "Amount to Pay: <strong>RM $Amount</strong><br><br>"; ?>
    Payment Method:<br>
    <input type="radio" name="Payment_Method" value="Cash" required> Cash<br>
    <input type="radio" name="Payment_Method" value="Card" required> Card<br>
    <input type="radio" name="Payment_Method" value="Online" required> Online<br><br>

    <input type="submit" value="Next">
</form>
<?php } ?>

<?php if ($step == 5) { ?>
<form method="post">
    <input type="hidden" name="step" value="6">
    <input type="hidden" name="Invoice_No" value="<?php echo $Invoice_No; ?>">
    <input type="hidden" name="Member_ID" value="<?php echo $Member_ID; ?>">
    <input type="hidden" name="Payment_Date" value="<?php echo $Payment_Date; ?>">
    <input type="hidden" name="Payment_Type" value="<?php echo $Payment_Type; ?>">
    <input type="hidden" name="Amount" value="<?php echo $Amount; ?>">
    <input type="hidden" name="Payment_Method" value="<?php echo $Payment_Method; ?>">
    <?php if ($Payment_Type == 'Membership') { ?>
        <input type="hidden" name="Membership_ID" value="<?php echo $Membership_ID; ?>">
    <?php } elseif ($Payment_Type == 'Program') { ?>
        <input type="hidden" name="Program_ID" value="<?php echo $Program_ID; ?>">
    <?php } ?>

    <?php echo "Amount to Pay: <strong>RM $Amount</strong><br><br>"; ?>
    <?php if ($Payment_Method == 'Cash') { ?>
        Cash Received: <input type="number" step="0.01" name="Cash_Received" required><br>

    <?php } elseif ($Payment_Method == 'Card') { ?>
        Card Type: <input type="text" name="Card_Type"><br>
        Last 4 Digits: <input type="text" name="Card_Last4Digit"><br>
        Bank: <input type="text" name="Card_Bank"><br>
    <?php } elseif ($Payment_Method == 'Online') { ?>
        Payment Provider: 
        <select name="Payment_Provider" id="Payment_Provider" required>
        <option value ="">Please Choose</option>
        <option value="TouchNGo">TouchNGo</option>
        <option value="Boost">Boost</option>
        <option value="GrabPay">GrabPay</option>
        <option value="ShopeePay">ShopeePay</option><br><br>
        </select><br><br>

        Transaction ID: <input type="text" name="Transaction_ID"><br>
    <?php } ?>

    <br>
    <input type="submit" value="Confirm Payment">
</form>
<?php } ?>

<?php if ($step == 6) { ?>
    <input type="hidden" name="step" value="6">
    <input type="hidden" name="Invoice_No" value="<?php echo $Invoice_No; ?>">
    <input type="hidden" name="Member_ID" value="<?php echo $Member_ID; ?>">
    <input type="hidden" name="Payment_Date" value="<?php echo $Payment_Date; ?>">
    <input type="hidden" name="Payment_Type" value="<?php echo $Payment_Type; ?>">
    <input type="hidden" name="Amount" value="<?php echo $Amount; ?>">
    <input type="hidden" name="Payment_Method" value="<?php echo $Payment_Method; ?>">
    <?php if ($Payment_Type == 'Membership') { ?>
        <input type="hidden" name="Membership_ID" value="<?php echo $Membership_ID; ?>">
    <?php } elseif ($Payment_Type == 'Program') { ?>
        <input type="hidden" name="Program_ID" value="<?php echo $Program_ID; ?>">
    <?php } ?>
    <?php
    $membershipValue = ($Payment_Type == 'Membership') ? "'$Membership_ID'" : "NULL";
    $programValue = ($Payment_Type == 'Program') ? "'$Program_ID'" : "NULL";

    mysqli_query($conn, "INSERT INTO Payment(Invoice_No, Member_ID, Membership_ID, Program_ID, Payment_Date, Amount, Payment_Type)
        VALUES('$Invoice_No','$Member_ID',
        $membershipValue,
        $programValue,
        '$Payment_Date',
        '$Amount',
        '$Payment_Type')
    ");

    if ($Payment_Method == 'Cash') {
        $Cash_Changed = $_POST['Cash_Received'] - $Amount;
        mysqli_query($conn, 
        "INSERT INTO Cash 
        VALUES ('$Invoice_No','{$_POST['Cash_Received']}','$Cash_Changed')");
    }
    if ($Payment_Method == 'Card') {
        mysqli_query($conn, 
        "INSERT INTO Card 
        VALUES ('$Invoice_No','{$_POST['Card_Type']}','{$_POST['Card_Last4Digit']}','{$_POST['Card_Bank']}')");
    }
    if ($Payment_Method == 'Online') {
        mysqli_query($conn, 
        "INSERT INTO Online 
        VALUES ('$Invoice_No','{$_POST['Payment_Provider']}','{$_POST['Transaction_ID']}')");
    }

    echo "<p>Payment recorded successfully</p>";
} ?>

</body>
</html>
