<?php
// PHP logic for form handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Create a new database connection
    $con = new mysqli("localhost", "root", "", "library_db");

    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // Prepare and execute the query
    $stmt = $con->prepare("SELECT * FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt_result = $stmt->get_result();

    // Check if the username exists
    if ($stmt_result->num_rows > 0) {
        $data = $stmt_result->fetch_assoc();

        // Verify password
        if ($data['password'] == $password) {
            // Redirect to admin_dashboard.php on successful login
            header("Location: admin_dashboard.php");
            exit(); // Make sure to stop script execution after redirection
        } else {
            $message = "<h2>Invalid username or password</h2>";
        }
    } else {
        $message = "<h2>Invalid username or password</h2>";
    }

    // Close the connection
    $stmt->close();
    $con->close();
} else {
    $message = "";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container vh-100">
        <div class="row justify-content-center h-100">
            <div class="card w-25 my-auto shadow">
                <div class="card-header text-center bg-primary text-white">
                    <h2>Login Form</h2>
                </div>
                <div class="card-body">
                    <!-- Display the message if available -->
                    <?php echo $message; ?>
                    
                    <form action="login.php" method="post">
                        <div class="form-group">
                            <label for="username">USERNAME</label>
                            <input type="text" id="username" class="form-control" name="username" required/><br>
                        </div>
                        <div class="form-group">
                            <label for="password">PASSWORD</label>
                            <input type="password" id="password" class="form-control" name="password" required/><br>
                        </div>
                        <input type="submit" class="btn btn-primary w-100" value="Login" name="submit">
                    </form>
                </div>
                <div class="card-footer text-left">
                    <small>&copy; spkc</small>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
