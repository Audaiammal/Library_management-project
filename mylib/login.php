<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body {
            background-color: #f0f8ff;
            color: white;
        }
        .login-container {
            margin-top: 100px;
        }
        .login-form {
            background-color: lightskyblue; 
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
        .login-form input[type="submit"] {
            background-color: #001f3f;
            border: none;
            margin-top:20px;
        }
        .login-form input[type="submit"]:hover {
            background-color: #004080;
        }
        .login-form h2 {
            margin-bottom: 30px;
        }
        .input-group-text {
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container login-container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form class="login-form" method="POST" action="process_login.php">
                <h2 class="text-center">Login</h2>
                <div class="form-horizontal">
                    <div class="control-group">
                        <label for="username" class="control-label">Username</label>
                        <div class="controls">
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter username" required>
                        </div>
                    </div>
                </div>
                <div class="form-horizontal">
                    <div class="control-group">
                        <label for="password" class="control-label">Password</label>
                        <div class="controls">
                            <div class="input-group">
                                <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" required>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="togglePassword">
                                        <img src="img/eye.png" alt="Show Password" id="eyeIcon" style="width: 20px; height: 20px;">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group text-center">
                    <input type="submit" value="Login" class="btn btn-primary btn-block">
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.src = 'img/eyeopen.png'; 
        } else {
            passwordInput.type = 'password';
            eyeIcon.src = 'img/eye.png'; 
        }
    });
</script>
</body>
</html>
