<?php
session_start();
include 'dbcon.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $member_id = mysqli_real_escape_string($conn, $_POST['member_id']);
    $book_id = mysqli_real_escape_string($conn, $_POST['book_id']);
    
    // Insert borrow request
    $sql = "INSERT INTO borrow_requests (member_id, book_id, request_date, status) VALUES ('$member_id', '$book_id', NOW(), 'pending')";
    
    if (mysqli_query($conn, $sql)) {
        echo json_encode(['status' => 'success', 'message' => 'Borrow request submitted successfully!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error submitting the request.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
