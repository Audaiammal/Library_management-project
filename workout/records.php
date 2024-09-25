<!-- Include jQuery locally or via CDN -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<div class="container mt-5">
    <ul class="nav nav-tabs card-header-tabs">
        <!-- Your existing tabs here -->
    </ul>
</div>

<div class="float-end mt-5">
    <label>Records per page:</label>
    <select id="recordsPerPage" class="form-select d-inline-block w-auto">
        <option value="10">10</option>
        <option value="25">25</option>
        <option value="50">50</option>
        <option value="100">100</option>
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
        <!-- Records will be populated here via AJAX -->
    </tbody>
</table>

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
</script>
