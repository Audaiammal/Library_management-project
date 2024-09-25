<?php
session_start();
include 'dbcon.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $transaction_id = mysqli_real_escape_string($conn, $_POST['transaction_id']);
    
    // Get the current date and calculate the due date (e.g., 14 days from now)
    $issue_date = date('Y-m-d H:i:s');
    $due_date = date('Y-m-d H:i:s', strtotime('+14 days'));

    // Check if the member has any borrowed books
    $check_books_sql = "SELECT COUNT(*) as total FROM transactions WHERE member_id = (SELECT member_id FROM transactions WHERE id = '$transaction_id') AND status = 'borrowed'";
    $check_result = mysqli_query($conn, $check_books_sql);
    $check_data = mysqli_fetch_assoc($check_result);
    
    if ($check_data['total'] >= 3) {
        echo json_encode(['status' => 'error', 'message' => 'Cannot issue more than 3 books.']);
        exit;
    }

    // Update transaction status to issued and set the due date
    $sql = "UPDATE transactions SET status = 'issued', due_date = '$due_date' WHERE id = '$transaction_id'";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(['status' => 'success', 'message' => 'Book issued successfully!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error in issuing the book.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
