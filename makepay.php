<?php
include 'connect.php';

$receipt = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pay_type = $_POST['Pay_Type'];
    $member_id = $_POST['Member_ID'];
    $payment_method = $_POST['Payment_Method'];
    $payment_date = date('Y-m-d');
    $invoice_no = 'P' . time();

    # Handle payment for Membership or Program

    # Scenario 1: Membership Payment
    if ($pay_type == 'Membership') {
        $membership_type = $_POST['Membership_Type'];
        $amount = 0;
        switch ($membership_type) {
            # Pre-set amount for each membership type
            case 'Monthly': $amount = 50; break;
            case 'Quarterly': $amount = 80; break;
            case 'Yearly': $amount = 120; break;
        }
        $membership_id = 'M' . $member_id;
        $start_date = $payment_date;
        # Calculate expiry date
        $expiry_date = new DateTime($start_date);
        switch ($membership_type) {
            # If existing membership, extend from current expiry date
            case 'Monthly': $expiry_date->modify('+1 month'); break;
            case 'Quarterly': $expiry_date->modify('+3 months'); break;
            case 'Yearly': $expiry_date->modify('+1 year'); break;
        }
        $expiry_date_str = $expiry_date->format('Y-m-d'); # YYYY-MM-DD

        # Insert into Table "Membership"
        $stmt = $conn->prepare("INSERT INTO Membership (Membership_ID, Member_ID, Membership_Type, Membership_Status, Start_Date, Expiry_Date) VALUES (?, ?, ?, 'Active', ?, ?)");
        $stmt->bind_param("sssss", $membership_id, $member_id, $membership_type, $start_date, $expiry_date_str);
        $stmt->execute();
        $stmt->close();

        # Insert into Table "Payment"
        $stmt = $conn->prepare("INSERT INTO Payment (Invoice_No, Member_ID, Membership_ID, Payment_Date, Amount, Payment_Type) VALUES (?, ?, ?, ?, ?, 'Membership')");
        $stmt->bind_param("ssssd", $invoice_no, $member_id, $membership_id, $payment_date, $amount);
        $stmt->execute();
        $stmt->close();

        # Print the receipt
        $receipt = "Receipt\nInvoice No: $invoice_no\nMember ID: $member_id\nPayment Date: $payment_date\nAmount: RM$amount\nType: Membership ($membership_type)";

    # Scenario 2: Program Payment
    } elseif ($pay_type == 'Program') {
        $program_id = $_POST['Program_ID'];
        # Get Program fee
        $stmt = $conn->prepare("SELECT Program_Fee FROM Program WHERE Program_ID = ?");
        $stmt->bind_param("s", $program_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $amount = $row['Program_Fee'];
        $stmt->close();

        # Insert into Table "Enrolment"
        $stmt = $conn->prepare("INSERT INTO Enrolment (Member_ID, Program_ID, Enrolment_Date) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $member_id, $program_id, $payment_date);
        $stmt->execute();
        $stmt->close();

        # Insert into Table "Payment"
        $stmt = $conn->prepare("INSERT INTO Payment (Invoice_No, Member_ID, Program_ID, Payment_Date, Amount, Payment_Type) VALUES (?, ?, ?, ?, ?, 'Program')");
        $stmt->bind_param("ssssd", $invoice_no, $member_id, $program_id, $payment_date, $amount);
        $stmt->execute();
        $stmt->close();

        # Print the receipt
        $receipt = "Receipt\nInvoice No: $invoice_no\nMember ID: $member_id\nPayment Date: $payment_date\nAmount: RM$amount\nType: Program ($program_id)";

    }

    # Handle payment method
    if ($payment_method == 'Card') {
        $card_type = $_POST['Card_Type'];
        $card_last4 = $_POST['Card_Last4'];
        $card_bank = $_POST['Card_Bank'];
        $stmt = $conn->prepare("INSERT INTO Card (Invoice_No, Card_Type, Card_Last4Digit, Card_Bank) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $invoice_no, $card_type, $card_last4, $card_bank);
        $stmt->execute();
        $stmt->close();
        $receipt .= "\nPayment Method: $payment_method ($card_type ****$card_last4)";
    } elseif ($payment_method == 'Online') {
        $payment_provider = $_POST['Payment_Provider'];
        $transaction_id = $_POST['Transaction_ID'];
        $stmt = $conn->prepare("INSERT INTO Online (Invoice_No, Payment_Provider, Transaction_ID) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $invoice_no, $payment_provider, $transaction_id);
        $stmt->execute();
        $stmt->close();
        $receipt .= "\nPayment Method: $payment_provider (Transaction ID: $transaction_id)";
    } elseif ($payment_method == 'Cash') {
        $cash_received = $_POST['Cash_Received'];
        $cash_changed = $cash_received - $amount;
        $stmt = $conn->prepare("INSERT INTO Cash (Invoice_No, Cash_Received, Cash_Changed) VALUES (?, ?, ?)");
        $stmt->bind_param("sdd", $invoice_no, $cash_received, $cash_changed);
        $stmt->execute();
        $stmt->close();
        $receipt .= "\nPayment Method: Cash\nCash Received: RM$cash_received\nChange: RM$cash_changed";
    }

    $conn->close();
}
?>

 # get_programs
<?php
include 'connect.php';

$category = $_GET['category'];

$sql = "SELECT Program_ID, Program_Name, Program_Fee FROM Program WHERE Program_Category = '$category'";

$result = $conn->query($sql);

$programs = [];

while ($row = $result->fetch_assoc()) {
    $programs[] = $row;
}

echo json_encode($programs);

$conn->close();
?>

<html>
<head>
    <title>Make Payment</title>
    <script>
        function toggleSections() {
            var payType = document.querySelector('input[name="Pay_Type"]:checked').value;
            document.getElementById('membershipSection').style.display = payType === 'Membership' ? 'block' : 'none';
            document.getElementById('programSection').style.display = payType === 'Program' ? 'block' : 'none';
        }

        function updateMembershipAmount() {
            var type = document.getElementById('Membership_Type').value;
            var amount = 0;
            switch (type) {
                case 'Monthly': amount = 50; break;
                case 'Quarterly': amount = 80; break;
                case 'Yearly': amount = 120; break;
            }
            document.getElementById('amount').value = amount;
        }

        function loadPrograms() {
            var category = document.getElementById('Program_Category').value;
            fetch('get_programs.php?category=' + category)
                .then(response => response.json())
                .then(data => {
                    var select = document.getElementById('Program_ID');
                    select.innerHTML = '<option value="">Select Program</option>';
                    data.forEach(program => {
                        var option = document.createElement('option');
                        option.value = program.Program_ID;
                        option.text = program.Program_Name + ' - RM' + program.Program_Fee;
                        option.dataset.fee = program.Program_Fee;
                        select.appendChild(option);
                    });
                });
        }

        function updateProgramAmount() {
            var select = document.getElementById('Program_ID');
            var selected = select.options[select.selectedIndex];
            if (selected.dataset.fee) {
                document.getElementById('amount').value = selected.dataset.fee;
            }
        }

        function togglePaymentFields() {
            var method = document.getElementById('Payment_Method').value;
            document.getElementById('cashFields').style.display = method === 'Cash' ? 'block' : 'none';
            document.getElementById('cardFields').style.display = (method === 'Credit Card' || method === 'Debit Card') ? 'block' : 'none';
            document.getElementById('paypalFields').style.display = method === 'PayPal' ? 'block' : 'none';
        }

        window.onload = function() {
            document.querySelectorAll('input[name="Pay_Type"]').forEach(radio => radio.addEventListener('change', toggleSections));
            document.getElementById('Membership_Type').addEventListener('change', updateMembershipAmount);
            document.getElementById('Program_Category').addEventListener('change', loadPrograms);
            document.getElementById('Program_ID').addEventListener('change', updateProgramAmount);
            document.getElementById('Payment_Method').addEventListener('change', togglePaymentFields);
            toggleSections();
            togglePaymentFields();
        };
    </script>
</head>
<body>
    <form action="makepay.php" method="post">
        <h1>Make Payment</h1>
        <h2>Pay for?</h2>
        <input type="radio" name="Pay_Type" value="Membership" checked onchange="toggleSections()"> Membership
        <input type="radio" name="Pay_Type" value="Program" onchange="toggleSections()"> Program

        <div id="membershipSection">
            <h3>For Membership</h3>
            Member ID: <input type="text" name="Member_ID" required><br><br>
            Membership Type:
            <select name="Membership_Type" id="Membership_Type" required onchange="updateMembershipAmount()">
                <option value="Monthly">Monthly - RM50</option>
                <option value="Quarterly">Quarterly - RM80</option>
                <option value="Yearly">Yearly - RM120</option>
            </select><br><br>
            Amount: RM<input type="text" id="amount" name="amount" readonly><br><br>
            Pay via:
            <select name="Payment_Method" id="Payment_Method" required onchange="togglePaymentFields()">
                <option value="Card">Card</option>
                <option value="Online">Online</option>
                <option value="Cash">Cash</option>
            </select><br><br>
            <div id="cardFields" style="display:none;">
                Card Type: <input type="text" name="Card_Type" placeholder="Visa/Mastercard"><br>
                Last 4 Digits: <input type="text" name="Card_Last4" maxlength="4"><br>
                Bank: <input type="text" name="Card_Bank"><br><br>
            </div>
            <div id="onlineFields" style="display:none;">
                Payment Provider: <input type="text" name="Payment_Provider"><br>
                Transaction ID: <input type="text" name="Transaction_ID"><br><br>
            </div>
            <div id="cashFields" style="display:none;">
                Cash Received: RM<input type="number" name="Cash_Received" step="0.01"><br><br>
            </div>
        </div>

        <div id="programSection" style="display:none;">
            <h3>For Program</h3>
            Member ID: <input type="text" name="Member_ID" required><br><br>
            Program Category:
            <select name="Program_Category" id="Program_Category" required onchange="loadPrograms()">
                <option value="">Select Category</option>
                <option value="Yoga">Yoga</option>
                <option value="Fitness">Fitness</option>
                <option value="Nutrition">Nutrition</option>
                <option value="Physiotherapy">Physiotherapy</option>
            </select><br><br>
            Program:
            <select name="Program_ID" id="Program_ID" required onchange="updateProgramAmount()">
                <option value="">Select Program</option>
            </select><br><br>
            Amount: RM<input type="text" id="amount" name="amount" readonly><br><br>
            Pay via:
            <select name="Payment_Method" id="Payment_Method" required onchange="togglePaymentFields()">
                <option value="Card">Card</option>
                <option value="Online">Online</option>
                <option value="Cash">Cash</option>
            </select><br><br>
            <div id="cardFields" style="display:none;">
                Card Type: <input type="text" name="Card_Type" placeholder="Visa/Mastercard"><br>
                Last 4 Digits: <input type="text" name="Card_Last4" maxlength="4"><br>
                Bank: <input type="text" name="Card_Bank"><br><br>
            </div>
            <div id="onlineFields" style="display:none;">
                Payment Provider: <input type="text" name="Payment_Provider"><br>
                Transaction ID: <input type="text" name="Transaction_ID"><br><br>
            </div>
            <div id="cashFields" style="display:none;">
                Cash Received: RM<input type="number" name="Cash_Received" step="0.01"><br><br>
            </div>
        </div>

        <input type="submit" value="Make Payment">
    </form>

    <?php if ($receipt): ?>
        <pre><?php echo $receipt; ?></pre>
        <a href="main.html">Back to Home</a>
    <?php endif; ?>
</body>
</html>
