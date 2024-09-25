<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Carousel</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Make the images fit within a certain height and width, maintaining aspect ratio */
        .carousel-item img {
            width: 50%; 
            height: 500px; 
            object-fit: contain;
            padding: 50px;
        }

        .carousel-control-prev-icon, 
        .carousel-control-next-icon {
          filter: invert(100%); /* Make the previous/next icons visible on dark background */
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
        <button class="carousel-control-prev" type="button" data-target="#imageCarousel" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-target="#imageCarousel" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </button>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Re-initialize the carousel with the auto-scroll interval
        $('#imageCarousel').carousel({
            interval: 3000,  // 3 seconds between slides
            pause: 'false',  // Ensures that the carousel does not stop on hover
            wrap: true       // Loops back to the first slide after the last slide
        });
    </script>
</body>
</html>
