<?php

session_start();

include('connection.php');

//admin authentication
if (!isset($_SESSION['user']) || !isset($_SESSION['admin'])) {
    echo "<script>alert('Please login to continue!')</script>";
    echo '<script>window.location="login.php"</script>';
} else if ($_SESSION['admin'] == 0) {
    echo "<script>alert('Please login to continue')</script>";
    echo '<script>window.location="login.php"</script>';
}


if (!isset($_POST['product_name']) || !isset($_POST['price']) ||
    !isset($_POST['quantity'])
) {
    echo "<script>alert('Fill all the fields correctly!')</script>";
    echo '<script>window.location="admin_panel.php"</script>';
}

$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "<script>alert('Sorry, your file is too large')</script>";
    $uploadOk = 0;
}
// Allow certain file formats
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
) {
    echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed')</script>";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "<script>alert('Sorry, your file was not uploaded')</script>";
// if everything is ok, try to upload file
} else {

    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    //adding an unique id to distinguish between images
    $image_path = $target_dir . uniqid() . $_FILES["fileToUpload"]["name"];

    //echo $image_path;

    //query to insert into product table
    $insert_into_products = "insert into products (p_name,image,price,quantity) VALUES ('$product_name','$image_path','$price','$quantity')";
    $connection->query($insert_into_products);

    //saving image
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $image_path)) {
        echo "<script>alert('Item successfully saved!')</script>";
        echo '<script>window.location="admin_panel.php"</script>';
    } else {
        echo "<script>alert('Sorry, there was an error inserting items')</script>";
        echo '<script>window.location="admin_panel.php"</script>';
    }
}
?>