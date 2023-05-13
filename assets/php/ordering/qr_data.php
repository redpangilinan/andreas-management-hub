<?php
include "../connection.php";

// Fetch the contact number of the owner from the database
$sql = "SELECT contact_no FROM tb_accounts WHERE account_type = 'Owner' LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $contactNo = $row['contact_no'];
    if ($contactNo == "") {
        $contactNo = 'N/A';
    }
} else {
    $contactNo = 'N/A';
}

// Return the contact number as JSON
echo "Contact/GCash: " . $contactNo;

$conn->close();
