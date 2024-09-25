<?php
include 'dbcon.php'; // Include your database connection file

$searchTerm = mysqli_real_escape_string($conn, $_GET['term']);

$query = "SELECT * FROM book WHERE Booktitle LIKE '%$searchTerm%' AND Copies > 0";
$result = mysqli_query($conn, $query);
$books = [];

while ($row = mysqli_fetch_assoc($result)) {
    $books[] = $row;
}

header('Content-Type: application/json');
echo json_encode($books);
?>
