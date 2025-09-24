<?php
session_cache_limiter(FALSE);
session_start();

if (isset($_POST["Ledger"])) {

    include("../../../connect.php");
    $currentdate = date("Y-m-d H:i:s");

    $Ledger = mysqli_real_escape_string($connection, $_POST["Ledger"]);
    $Group = mysqli_real_escape_string($connection, $_POST["Group"]);
    $EntryDate = mysqli_real_escape_string($connection, $_POST["EntryDate"]);
    $Amount = mysqli_real_escape_string($connection, $_POST["Amount"]);
    $Remarks = mysqli_real_escape_string($connection, $_POST["Remarks"]);
    $PaymentMode = mysqli_real_escape_string($connection, $_POST["PaymentMode"]);
    $InvoiceNo = mysqli_real_escape_string($connection, $_POST["InvoiceNo"]);
    $LocationcodeAdmin = mysqli_real_escape_string($connection, $_POST["LocationCode"]);
    $Tag = mysqli_real_escape_string($connection, $_POST["Tag"]);

    $GroupID = $_SESSION['SESS_GROUP_ID'];
    $LocationCode = $LocationcodeAdmin;
    $ClientID = 1;
    $userid = $_SESSION['SESS_MEMBER_ID'];

    // Handle file uploads
    $photoFilePath = "";
    $pdfFilePath = "";
    $photoPathDB='';
    $pdfFilePathDB='';
	// echo getcwd(); 

	

	if (isset($_FILES['expensePhoto']) && $_FILES['expensePhoto']['error'] == 0) {
		$photoFileName = time() . '_' . basename($_FILES['expensePhoto']['name']);
		$photoTargetPath = "../uploads/photos/" . $photoFileName;  // ✅ Folder in same path as this PHP file
		$photoTargetPathDB = "uploads/photos/" . $photoFileName;  // ✅ Folder in same path as this PHP file
		
		
		if (move_uploaded_file($_FILES['expensePhoto']['tmp_name'], $photoTargetPath)) {
			$photoFilePath = $photoTargetPath;  // Save relative path in DB
			$photoPathDB = $photoTargetPathDB;  // Save relative path in DB
			
		}
	}
	 

	if (isset($_FILES['expensePDF']) && $_FILES['expensePDF']['error'] == 0) {
		$pdfFileName = time() . '_' . basename($_FILES['expensePDF']['name']);
		$pdfTargetPath = "../uploads/pdfs/" . $pdfFileName;  // ✅ No ../../../
		$pdfTargetPathDB = "uploads/pdfs/" . $pdfFileName;  // ✅ No ../../../
	
		if (move_uploaded_file($_FILES['expensePDF']['tmp_name'], $pdfTargetPath)) {
			$pdfFilePath = $pdfTargetPath;
			$pdfFilePathDB = $pdfTargetPathDB;
		}
	}
	
	

    try {
        // Insert into accountingtransaction (✅ with file paths)
        $AddPaymentMode = "INSERT INTO accountingtransaction 
        (ledgerid, date, transactiongroup, transactiontype, incomeamount, 
        expenseamount, transactionamount, remarks, createdby, 
        clientid, paymentmode, invoiceno, photo_path, pdf_path,tag)
        VALUES
        ('$Ledger', '$EntryDate', '$Group',
        (SELECT ledgertype FROM accountingledger WHERE ledgerid = '$Ledger'),
        (SELECT IF(ledgertype = 'Income', '1', '0') FROM accountingledger WHERE ledgerid = '$Ledger') * '$Amount',
        (SELECT IF(ledgertype = 'Income', '0', '1') FROM accountingledger WHERE ledgerid = '$Ledger') * '$Amount',
        '$Amount', '$Remarks', '$userid', '$LocationCode', '$PaymentMode', '$InvoiceNo', 
        '$photoPathDB', '$pdfFilePathDB','$Tag');";

        // Insert into salepaymentdetailsc (❌ without file paths)
        $AddPaymentMode .= "INSERT INTO salepaymentdetailsc 
        (customercode, paymentmode, amount, invoiceno, date, transactiontype, transactiongroup, clientid)
        VALUES
        ('$Ledger', '$PaymentMode', '$Amount', '$InvoiceNo', '$EntryDate',
        (SELECT IF(ledgertype = 'Income', 'IncomeEntry', 'ExpenseEntry') FROM accountingledger WHERE ledgerid = '$Ledger'),
        '$Group', '$LocationCode');";

        if (mysqli_multi_query($connection, $AddPaymentMode)) {
            echo "1";
        } else {
            echo "Error: " . $AddPaymentMode . " - " . mysqli_error($connection);
        }

    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
    }

} else {
    echo "Error Adding";
}
?>
