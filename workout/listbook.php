<?php include 'dbcon.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book List</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        table {
            background-color: #cfe7eb; 
            border-color: navy;
        }
        thead {
            background-color: navy;
            color: white;
        }
        .btn-edit {
            background-color: rgb(20, 12, 109);
            color: white;
        }
        .btn-delete {
            background-color: rgb(20, 12, 109); 
            color: white;
        }
        .btn-spacing{
            margin-right:10px;
        }
        .btn-edit:hover, .btn-delete:hover {
            opacity: 0.9; 
            color: white;
        }
        .card-custom {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow */
            background-color: navy; /* Navy background */
        }
        .nav-tabs .nav-link.active {
            background-color:grey;
            color:black;
        }

        .nav-tabs .nav-link {
            background-color:#cfe7eb;
            color:black; 

        }
        .nav-tabs .nav-link:hover {
            background-color: grey;
            color:black; 
        }
        .card-header-tabs{
            background-color:#cfe7eb;;
            text-align:center;
            justify-content: space-evenly;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">All</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">New Books</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Old Books</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Lost Books</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Damaged Books</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Subject for Replacement</a>
                    </li>
                </ul>
        </div>
    <div class="float-end mt-5">
                        <label>Records per page:</label>
                        <select class="form-select d-inline-block w-auto">
                            <option>10</option>
                            <option>25</option>
                            <option>50</option>
                            <option>100</option>
                        </select>
    
    </div>
        <h3 class="text-center" style="color: navy;">Books</h3>
        <table class="table table-bordered table-responsive-md">
            <thead>
                <tr>              
                    <th>Acc No</th>
                    <th>Book Title</th>
                    <th>Category</th>
                    <th>Author</th>
                    <th>Copies</th>
                    <th>Publisher</th>
                    <th>Publisher Name</th>
                    <th>ISBN</th>
                    <th>Copyright Year</th>
                    <th>Date Added</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="bookTableBody">
                <?php
                $query = $query = "SELECT *, DATE(Dateadded) AS Dateadded FROM book"; // Assuming you're fetching all columns

                $result = $conn->query($query);

                while ($row = $result->fetch_assoc()) {
                    echo "<tr id='book-{$row['id']}'>
                            <td>{$row['Accno']}</td>
                            <td>{$row['Booktitle']}</td>
                            <td>{$row['Category']}</td>
                            <td>{$row['Author']}</td>
                            <td>{$row['Copies']}</td>
                            <td>{$row['Publisher']}</td>
                            <td>{$row['Publishername']}</td>
                            <td>{$row['isbn']}</td>
                            <td>{$row['Copyright']}</td>
                            <td>{$row['Dateadded']}</td>
                            <td>{$row['Status']}</td>
                            <td>
                              <div class='btn-group' role='group' aria-label='Action buttons'>
                                <button class='btn btn-edit btn-sm btn-spacing' onclick='editBook({$row['id']})'>Edit</button>
                                <button class='btn btn-delete btn-sm btn-spacing' onclick='deleteBook({$row['id']})'>Delete</button>
                              </div>  
                            </td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function editBook(bookId) {
            window.location.href = edit_book.php?id=${bookId};
        }

        function deleteBook(bookId) {
            if (confirm('Are you sure you want to delete this book?')) {
                fetch(delete_book.php?id=${bookId})
                .then(response => response.text())  
                .then(data => {
                    if (data.trim() === 'success') { 
                        alert('Book deleted successfully!');
                        document.getElementById(book-${bookId}).remove(); 
                    } else {
                        alert(data);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error deleting the book'); 
                });
            }
        }
    </script>
    <script type="text/javascript">
    $(document).ready(function () {
        // Fetch initial records (default is 10)
        fetchRecords(10);

        // Handle change in records per page
        $('#recordsPerPage').change(function () {
            var recordsPerPage = $(this).val();
            fetchRecords(recordsPerPage);
        });

        // Function to fetch records via AJAX
        function fetchRecords(recordsPerPage) {
            $.ajax({
                url: 'fetch_books.php', // PHP file that fetches the records
                type: 'POST',
                data: { records_per_page: recordsPerPage },
                success: function (data) {
                    $('#bookTableBody').html(data); // Populate the table body
                },
                error: function (xhr, status, error) {
                    alert('Error fetching records: ' + error);
                }
            });
        }

        // Function to delete a book (already defined in your script)
        function deleteBook(bookId) {
            if (confirm('Are you sure you want to delete this book?')) {
                fetch(`delete_book.php?id=${bookId}`)
                .then(response => response.text())
                .then(data => {
                    if (data.trim() === 'success') {
                        alert('Book deleted successfully!');
                        $(`#book-${bookId}`).remove(); // Remove the book from the table
                    } else {
                        alert(data);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error deleting the book');
                });
            }
        }
    });

</body>
</html>