<?php
session_start();
include 'dbcon.php';

// Fetch returned books
$query = "SELECT t.transaction_id AS transaction_id, m.firstname, m.lastname, b.title AS book_title, t.borrow_date, t.return_date, t.status
          FROM transactions t
          JOIN member m ON t.member_id = m.id  
          JOIN book b ON t.book_id = b.id
          WHERE t.status = 'returned'";

$result = mysqli_query($conn, $query) or die('Query failed: ' . mysqli_error($conn));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Returned Books</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #001f3f;
            color: #ffffff;
        }
        .table {
            background-color: #003366;
        }
        .table th, .table td {
            color: #ffffff;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Returned Books</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Transaction ID</th>
                    <th>Member Name</th>
                    <th>Book Title</th>
                    <th>Borrow Date</th>
                    <th>Return Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['transaction_id']; ?></td>
                    <td><?php echo $row['firstname'] . ' ' . $row['lastname']; ?></td>
                    <td><?php echo $row['book_title']; ?></td>
                    <td><?php echo $row['borrow_date']; ?></td>
                    <td><?php echo $row['return_date']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
