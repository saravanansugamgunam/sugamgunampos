<?php
include("../../../connect.php");

if (isset($_POST['invoiceno'])) {
    $InvoiceNo = mysqli_real_escape_string($connection, $_POST['invoiceno']);

    $query = "SELECT photo_path, pdf_path FROM accountingtransaction WHERE invoiceno = '$InvoiceNo' LIMIT 1";
    $result = mysqli_query($connection, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $photo = $row['photo_path'];
        $pdf = $row['pdf_path'];

        if ($photo != "") {
            echo "<p><a href='../$photo' target='_blank'>📷 View Photo</a></p>";
        } else {
            echo "<p>No Photo Uploaded</p>";
        }

        if ($pdf != "") {
            echo "<p><a href='../$pdf' target='_blank'>📄 View PDF</a></p>";
        } else {
            echo "<p>No PDF Uploaded</p>";
        }
    } else {
        echo "No documents found.";
    }
}
?>
