<?php
session_start();
include 'dbcon.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $request_id = mysqli_real_escape_string($conn, $_POST['request_id']);
    
    // Update borrow request status
    $sql = "UPDATE borrow_requests SET status = 'rejected' WHERE id = '$request_id'";
    
    if (mysqli_query($conn, $sql)) {
        echo json_encode(['status' => 'success', 'message' => 'Borrow request rejected.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error rejecting the request.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
