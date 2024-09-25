<!DOCTYPE html>
<html lang="en">
<head>--
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPKC Library Dashboard</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar {
            background-color: navy !important;
        }
        .navbar-nav .nav-link {
            color: white !important;
        }
        .navbar-nav .nav-link:hover {
            color: skyblue !important;
        }
        .navbar-brand {
            color: white !important;
        }
        .navbar-nav {
            flex-grow: 1;
            justify-content: space-evenly;
        }
        #carouselArea {
            display: none;
            margin-top: 20px;
        }
        .add-user-heading {
            color: navy;
            cursor: pointer;
            margin: 20px 0 10px 0; 
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">                                      
        <a class="navbar-brand" href="https://www.spkcazk.com/">SPKC LIBRARY</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#" id="homeNavItem">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" id="userNavItem">User</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Transaction
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Borrow</a>
                        <a class="dropdown-item" href="#">View Returned Books</a>
                        <a class="dropdown-item" href="#">View Borrowed Books</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Member</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  id="bookNavItem" href="#">Book</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Search</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<div id="carouselArea" class="container">
    <?php include 'scrollpic.php'; ?>
</div>


<div id="userArea" class="container">

</div>
<div id="bookArea" class="container">

</div>



<script src="js/jquery-3.5.1.min.js"></script>                 
<script src="js/popper.min.js"></script>                  
<script src="js/bootstrap.min.js"></script> 
<script>
    $(document).ready(function() {
       
        $('#homeNavItem').on('click', function(event) {
            event.preventDefault(); 
            $('#carouselArea').show();
            $('#bookArea').hide(); 
            $('#userArea').hide(); 
        });

        
        $('#userNavItem').on('click', function(event) {
            event.preventDefault(); 
            $('#carouselArea').hide();
            $('#bookArea').hide(); 
            
            $('#userArea').html(
                '<h3 class="add-user-heading" onclick="location.href=\'adduser.php\';">ADD USER</h3><div id="userList"></div>'
            );
            
            
            $('#userList').load('listuser.php'); 
            $('#userArea').show(); 
        });
        $('#bookNavItem').on('click', function(event) {
            event.preventDefault(); 
            $('#carouselArea').hide(); 
            $('#userArea').hide();
            
            
            $('#bookArea').html(
                '<h3 class="add-user-heading" onclick="location.href=\'addbook.php\';">ADD BOOK</h3><div id="bookList"></div>'
            );
            
            
            $('#bookList').load('listbook.php'); 
            $('#bookArea').show(); 
        });


        
        $(document).on('click', '#navbarDropdown', function() {
            $(this).dropdown('toggle');
        });

        
        $('#homeNavItem').trigger('click'); 
    });
</script>

</body>
</html>