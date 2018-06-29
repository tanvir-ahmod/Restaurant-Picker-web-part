<?php
include('connection.php');
session_start();

// authentication
if (!isset($_SESSION['companyID'])) {
    echo "<script>alert('Please login to continue!')</script>";
    echo '<script>window.location="login.php"</script>';
}

if (!isset($_POST['id']))
    header('location:index.php');
$id = $_POST['id'];

//authenticating
$company_id = $_SESSION['companyID'];
$item_company_id_query = "SELECT * FROM item where id = '$id'";
$item_company_id = $connection->query($item_company_id_query)->fetch_assoc();

//if unauthorized user wants to edit data
if ($item_company_id['companyID'] != $company_id) {
    echo "<script>alert('You are not valid user to perform this task!')</script>";
    echo '<script>window.location="login.php"</script>';
}

$item_search_query = "SELECT * FROM item where id = '$id'";
$item = $connection->query($item_search_query)->fetch_assoc();

if (isset($_POST['submit'])) {

    //if not all data sent
    if (!isset($_POST['item_name']) || !isset($_POST['companyID']) || !isset($_POST['description']) ||
        !isset($_POST['price'])
    ) {
        echo "<script>alert('Please submit all data correctly!')</script>";
        echo '<script>window.location="index.php"</script>';
    }

    $item_name = $_POST['item_name'];
    $price = $_POST['price'];
    $company_id = $_POST['companyID'];
    $description = $_POST['description'];

    //if image is submitted
    if (isset($_FILES["fileToUpload"])) {
        $image_path = 'product_images/' . $_FILES["fileToUpload"]["name"];
        $sql_edit = "UPDATE item SET item_name = '$item_name', 
                      image='$image_path',price = '$price',
                      description = '$description' WHERE id = '$id'";

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $image_path)) {
            $connection->query($sql_edit);
            echo "<script>alert('Item successfully saved!')</script>";
            echo '<script>window.location="index.php"</script>';
        } else {
            echo "<script>alert('Sorry, there was an error inserting items')</script>";
            echo '<script>window.location="index.php"</script>';
        }
    } else {
        $sql_edit = "UPDATE  item SET item_name = '$item_name',
                      price = '$price',description = '$description' WHERE id = '$id'";
        $connection->query($sql_edit);

        echo "<script>alert('Successfully updated Item')</script>";
        echo '<script>window.location="index.php"</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Edit Item</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Bootstrap styles -->
    <link href="assets/css/bootstrap.css" rel="stylesheet"/>
    <!-- Customize styles -->
    <link href="assets/css/style.css" rel="stylesheet"/>
    <!-- font awesome styles -->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <!--[if IE 7]>
    <link href="css/font-awesome-ie7.min.css" rel="stylesheet">
    <![endif]-->

    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Favicons -->
    <link rel="shortcut icon" href="assets/ico/favicon.ico">
</head>
<body>
<!--
Lower Header Section
-->
<div class="container">
    <!--
    Body Section
    -->
    <div class="row">
        <div class="span12">
            <h3> Edit Items</h3>
            <hr class="soft"/>
            <div class="row">
                <div class="span4"></div>
                <div class="span6">
                    <div class="well">
                        <h5>Edit items</h5><br/>
                        Fill all the fields to Edit items<br/><br/><br/>
                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" value="<?php echo $id; ?>" name="id">
                            <input type="hidden" value="<?php echo 1; ?>" name="companyID">
                            <div class="control-group">
                                <label class="control-label">Product Name</label>
                                <div class="controls">
                                    <input type="text" name="item_name"
                                           value="<?= (isset($item_name)) ? $item_name : $item['item_name']; ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Price</label>
                                <div class="controls">
                                    <input type="text" name="price"
                                           value="<?= (isset($price)) ? $price : $item['price']; ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Description</label>
                                <div class="controls">
                                    <input type="text" name="description"
                                           value="<?= (isset($description)) ? $description : $item['description']; ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="inputEmail">Image</label>
                                <div class="controls">
                                    <input type="file" name="fileToUpload" id="fileToUpload">
                                </div>
                            </div>

                            <div class="controls">
                                <button type="submit" name="submit" class="btn block">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="span1"> &nbsp;</div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

