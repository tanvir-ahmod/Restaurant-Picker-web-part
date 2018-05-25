<?php

include('connection.php');

if (!isset($_POST['item_name']) || !isset($_POST['price'])
) {
    echo "<script>alert('Fill all the fields correctly!')</script>";
    echo '<script>window.location="add_items.php"</script>';
}

$target_dir = "product_images/";
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

    $company_id = 1; // $_SESSION['companyID'];
    $item_name = $_POST['item_name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $image_path = $target_dir . $_FILES["fileToUpload"]["name"];

    //query to insert into item table
    $insert_into_products = "insert into item (companyID,item_name,description,price,image) 
                              VALUES ('$company_id','$item_name','$description','$price','$image_path')";
    $isInserted = $connection->query($insert_into_products);

    //saving image
    if ($isInserted && move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $image_path)) {
        echo "<script>alert('Item inserted!')</script>";
        echo '<script>window.location="admin_panel.php"</script>';
    } else {
        echo "<script>alert('Sorry, there was an error inserting items')</script>";
        echo '<script>window.location="admin_panel.php"</script>';
    }
}