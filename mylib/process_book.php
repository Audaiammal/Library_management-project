<?php
include 'dbcon.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Accno= mysqli_real_escape_string($conn, $_POST['Accno']);
    $Booktitle= mysqli_real_escape_string($conn, $_POST['Booktitle']);
    $Category = mysqli_real_escape_string($conn, $_POST['Category']);
    $Author = mysqli_real_escape_string($conn, $_POST['Author']);
    $Copies = mysqli_real_escape_string($conn, $_POST['Copies']);
    $Publisher = mysqli_real_escape_string($conn, $_POST['Publisher']);
    $Publishername = mysqli_real_escape_string($conn, $_POST['Publishername']);
    $isbn= mysqli_real_escape_string($conn, $_POST['isbn']);
    $Copyright = mysqli_real_escape_string($conn, $_POST['Copyright']);
    $Dateadded = date('Y-m-d', strtotime($_POST['Dateadded']));
    $Status= mysqli_real_escape_string($conn, $_POST['Status']);
    $check_book = "SELECT * FROM book WHERE isbn='$isbn'";
    $result = mysqli_query($conn, $check_book);
    
    if (mysqli_num_rows($result) > 0) {
        echo json_encode(['status' => 'error', 'message' => 'book already exists. Please add another.']);
    } else {
        
        $sql = "INSERT INTO book (Accno,Booktitle,Category,Author,Copies,Publisher,Publishername,isbn,Copyright,Dateadded,Status) VALUES ('$Accno', '$Booktitle', '$Category', '$Author','$Copies', '$Publisher', '$Publishername', '$isbn','$Copyright', '$Dateadded','$Status')";
        
        if (mysqli_query($conn, $sql)) {
            echo json_encode(['status' => 'success', 'message' => 'Book added successfully!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => mysqli_error($conn)]);
        }
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>