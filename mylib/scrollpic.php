<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Carousel</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        
        .carousel-item img {
            width: 50%; 
            height: 500px; 
            object-fit: contain;
            padding: 50px;
        }
    </style>
</head>
<body>
    <div id="imageCarousel" class="carousel slide" data-ride="carousel" data-interval="3000"> 
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="./img/libbuild.jpeg" class="d-block w-100" alt="First Image">
            </div>
            <div class="carousel-item">
                <img src="./img/libconvo.jpeg" class="d-block w-100" alt="Second Image">
            </div>
            <div class="carousel-item">
                <img src="./img/libstone.jpeg" class="d-block w-100" alt="Third Image">
            </div>
            <div class="carousel-item">
                <img src="./img/maingate.jpeg" class="d-block w-100" alt="Fourth Image">
            </div>
        </div>
    </div>

    
    <script src="js/jquery-3.5.1.min.js"></script>                  
    <script src="js/popper.min.js"></script>                  
    <script src="js/bootstrap.min.js"></script> 
    <script>
        
        $('#imageCarousel').carousel({
            interval: 3000,  
            pause: 'false', 
            wrap: true      
        });
    </script>
</body>
</html>
