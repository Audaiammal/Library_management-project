<?php
session_start();
include 'dbcon.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $transaction_id = $_POST['transaction_id'];

    // Update the status to 'returned' and set the return date
    $query = "UPDATE transactions 
              SET status = 'returned', return_date = NOW() 
              WHERE transaction_id = '$transaction_id'";

    if (mysqli_query($conn, $query)) {
        // Redirect back to borrow history
        header("Location: borrow_history.php");
        exit();
    } else {
        echo "Error: Could not return the book.";
    }
}
?>
