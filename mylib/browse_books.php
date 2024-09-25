<?php
session_start();
include 'dbcon.php';

// Fetch all books
$books_query = "SELECT * FROM book";
$books = mysqli_query($conn, $books_query);
?>

<div class="container mt-5">
    <h2>Available Books</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Book Title</th>
                <th>Author</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($books) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($books)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['Booktitle']); ?></td>
                        <td><?php echo htmlspecialchars($row['Author']); ?></td>
                        <td>
                            <button class="btn btn-primary borrow-btn" data-id="<?php echo $row['id']; ?>">Borrow</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">No books available.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function() {
    // Handle borrow button click
    $('.borrow-btn').on('click', function() {
        var bookId = $(this).data('id');
        var memberId = 1; // Replace with actual logged-in member ID

        $.ajax({
            type: 'POST',
            url: 'process_borrow.php',
            data: { member_id: memberId, book_id: bookId },
            success: function(response) {
                var result = JSON.parse(response);
                alert(result.message);
                location.reload(); // Reload the page to see updated borrow requests
            },
            error: function() {
                alert('Error processing the request.');
            }
        });
    });
});
</script>


