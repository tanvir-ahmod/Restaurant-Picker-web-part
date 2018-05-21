<?php

include('connection.php');

if (!isset($_POST['restaurant_name']) || !isset($_POST['password']) ||
    !isset($_POST['email']) || !isset($_POST['phone'])
) {
    echo "<script>alert('Fill all the fields correctly!')</script>";
    echo '<script>window.location="company_registration.php"</script>';
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

    $restaurant_name = $_POST['restaurant_name'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    //adding an unique id to distinguish between images
    $image_path = $target_dir . uniqid() . $_FILES["fileToUpload"]["name"];

    //echo $image_path;

    //query to insert into company table
    $insert_into_products = "insert into company (name,password,email,phone,image) 
                              VALUES ('$restaurant_name','$password','$email','$phone','$image_path')";
    $connection->query($insert_into_products);

    //saving image
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $image_path)) {
        echo "<script>alert('Registration complete!')</script>";
        echo '<script>window.location="admin_panel.php"</script>';
    } else {
        echo "<script>alert('Sorry, there was an error inserting items')</script>";
        echo '<script>window.location="admin_panel.php"</script>';
    }
}