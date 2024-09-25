<?php
include 'dbcon.php'; // Include your database connection file

$search_query = '';
if (isset($_POST['search'])) {
    $search_query = mysqli_real_escape_string($conn, $_POST['search']);
}

// Fetch available books based on the search query
$query = "SELECT * FROM book WHERE Status = 'new' AND (Booktitle LIKE '%$search_query%' OR Author LIKE '%$search_query%')";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>

<div class="container mt-5">
    <h2>Available Books</h2>

    <!-- Search Form -->
    <form method="POST" class="mb-4">
        <input type="text" name="search" placeholder="Search by title or author" class="form-control" value="<?php echo htmlspecialchars($search_query); ?>">
        <button type="submit" class="btn btn-primary mt-2">Search</button>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Book Title</th>
                <th>Author</th>
                <th>Copies</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['Booktitle']; ?></td>
                    <td><?php echo $row['Author']; ?></td>
                    <td><?php echo $row['Copies']; ?></td>
                    <td>
                        <button class="btn btn-success borrow-btn" data-id="<?php echo $row['id']; ?>">Borrow</button>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script>
$(document).ready(function() {
    // Handle borrow button click
    $('.borrow-btn').on('click', function() {
        var bookId = $(this).data('id');
        var memberId = '<?php echo $member_id; ?>'; // Replace with the actual member ID from the session or database

        $.ajax({
            type: 'POST',
            url: 'process_borrow.php',
            data: { book_id: bookId, member_id: memberId },
            success: function(response) {
                var result = JSON.parse(response);
                alert(result.message);
                if (result.status === 'success') {
                    location.reload(); // Reload the page to see updated books
                }
            }
        });
    });
});
</script>

</body>
</html>
