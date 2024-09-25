<?php
session_start();
include 'dbcon.php';
$member_id = $_SESSION['member_id']; // Assuming member_id is stored in session

// Fetch borrow history
$borrow_history_query = "SELECT t.*, b.Booktitle 
                         FROM transactions t 
                         JOIN book b ON t.book_id = b.id 
                         WHERE t.member_id = '$member_id'";

$borrow_history = mysqli_query($conn, $borrow_history_query);
?>

<div class="container mt-5">
    <h2>Your Borrow History</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Book Title</th>
                <th>Borrow Date</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($borrow_history) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($borrow_history)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['Booktitle']); ?></td>
                        <td><?php echo htmlspecialchars($row['borrow_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['due_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['status']); ?></td>
                        <td>
                            <?php if ($row['status'] == 'borrowed'): ?>
                                <button class="btn btn-warning return-btn" data-id="<?php echo $row['transaction_id']; ?>">Return</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No borrow history found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function() {
    // Handle return button click
    $('.return-btn').on('click', function() {
        var transactionId = $(this).data('id');

        $.ajax({
            type: 'POST',
            url: 'process_return.php',
            data: { transaction_id: transactionId },
            success: function(response) {
                var result = JSON.parse(response);
                alert(result.message);
                location.reload(); // Reload the page to see updated borrow history
            },
            error: function() {
                alert('Error processing the return.');
            }
        });
    });
});
</script>


