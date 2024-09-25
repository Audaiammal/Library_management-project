<?php
include 'dbcon.php'; // Include your database connection file

// Fetch pending borrow requests
$query = "SELECT t.*, b.Booktitle, m.firstname, m.lastname FROM transactions t
          JOIN book b ON t.book_id = b.id
          JOIN member m ON t.member_id = m.member_id
          WHERE t.status = 'pending'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Borrow Requests</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Pending Borrow Requests</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Member Name</th>
                <th>Book Title</th>
                <th>Borrow Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['firstname'] . ' ' . $row['lastname']; ?></td>
                    <td><?php echo $row['Booktitle']; ?></td>
                    <td><?php echo $row['borrow_date']; ?></td>
                    <td>
                        <button class="btn btn-success accept-btn" data-id="<?php echo $row['id']; ?>">Accept</button>
                        <button class="btn btn-danger reject-btn" data-id="<?php echo $row['id']; ?>">Reject</button>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function() {
    // Accept borrow request
    $('.accept-btn').on('click', function() {
        var requestId = $(this).data('id');
        
        $.ajax({
            type: 'POST',
            url: 'process_accept_borrow.php',
            data: { request_id: requestId, action: 'accept' },
            success: function(response) {
                var result = JSON.parse(response);
                alert(result.message);
                if (result.status === 'success') {
                    location.reload(); // Reload the page to see updated requests
                }
            }
        });
    });

    // Reject borrow request
    $('.reject-btn').on('click', function() {
        var requestId = $(this).data('id');
        
        $.ajax({
            type: 'POST',
            url: 'process_accept_borrow.php',
            data: { request_id: requestId, action: 'reject' },
            success: function(response) {
                var result = JSON.parse(response);
                alert(result.message);
                if (result.status === 'success') {
                    location.reload(); // Reload the page to see updated requests
                }
            }
        });
    });
});
</script>

</body>
</html>
