<?php
session_start();
include 'dbcon.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $transaction_id = mysqli_real_escape_string($conn, $_POST['transaction_id']);
    
    // Update transaction status
    $update_sql = "UPDATE transactions SET status = 'returned', return_date = NOW() WHERE transaction_id = '$transaction_id'";
    
    if (mysqli_query($conn, $update_sql)) {
        echo json_encode(['status' => 'success', 'message' => 'Book returned successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error returning the book.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
