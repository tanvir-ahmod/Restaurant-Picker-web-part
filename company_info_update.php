<?php
session_start();
include('connection.php');


// authentication
if (!isset($_SESSION['companyID'])) {
    echo "<script>alert('Please login to continue!')</script>";
    echo '<script>window.location="login.php"</script>';
}



if (!isset($_GET['id'])) {
    echo "<script>alert('You can not edit this info!')</script>";
    echo '<script>window.location="index.php"</script>';
}

$id = $_GET['id'];
$company_id = $_SESSION['companyID'];

//if unauthorized user wants to edit data
if ($id != $company_id) {
    echo "<script>alert('You are not valid user to perform this task!')</script>";
    echo '<script>window.location="login.php"</script>';
}

$info_query = "SELECT * FROM company WHERE id = '$id'";
$company_info = $connection->query($info_query)->fetch_assoc();


if (isset($_POST['submit'])) {

    //if not all data sent
    /* if (!isset($_POST['restaurant_name']) || !isset($_POST['password']) ||
         !isset($_POST['email']) || !isset($_POST['phone'])
     ) {
         echo "<script>alert('Fill all the fields correctly!')</script>";
         echo '<script>window.location="company_registration.php"</script>';
     }*/

    $restaurant_name = $_POST['restaurant_name'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    //if image is submitted
    if (isset($_FILES["fileToUpload"]["name"])) {
        $image_path = 'images/' . $_FILES["fileToUpload"]["name"];
        $sql_edit = "UPDATE  company SET name = '$restaurant_name', password = '$password', 
                      image='$image_path',phone = '$phone',
                      email = '$email' WHERE ID = '$id'";

        $isUpdated = $connection->query($sql_edit);

        if ($isUpdated || move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $image_path)) {

            echo "<script>alert('Information saved successfully!')</script>";
            echo '<script>window.location="index.php"</script>';
        } else {
            echo "<script>alert('Sorry, there was an error inserting items')</script>";
            echo '<script>window.location="index.php"</script>';
        }

    } else {
        $sql_edit = "UPDATE  company SET name = '$restaurant_name', password = '$password',
                      phone = '$phone',email = '$email' WHERE ID = '$id'";
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
    <title>Update Info</title>
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
	Upper Header Section
-->
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="topNav">
        <div class="container">
            <div class="alignR">
            </div>
            <a href="index.php"> <span class="icon-home"></span> Home</a>
            <a href="login.php"><span class="icon-edit"></span> Free Register </a>
            <a href="logout.php"><?php if (isset($_SESSION['user'])) echo "Logout"; ?></a>

        </div>
    </div>
</div>


<!--
Lower Header Section
-->
<div class="container">


    <!--
    Navigation Bar Section
    -->

    <!--
    Body Section
    -->
    <div class="row">

        <div class="span12">
            <!--<ul class="breadcrumb">
                <li><a href="index.php">Home</a> <span class="divider">/</span></li>
                <li class="active">Registration</li>
            </ul>-->
            <h3>Update</h3>
            <hr class="soft"/>

            <div class="row">
                <div class="span4"></div>
                <div class="span6">
                    <div class="well">
                        <h5>Update info</h5><br/>
                        Fill all the fields to Update<br/><br/><br/>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="control-group">
                                <label class="control-label">Restaurant Name</label>
                                <div class="controls">
                                    <input type="text" name="restaurant_name"
                                           value="<?= (isset($restaurant_name)) ? $restaurant_name : $company_info['name']; ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Password</label>
                                <div class="controls">
                                    <input type="password" name="password">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Email</label>
                                <div class="controls">
                                    <input type="email" name="email"
                                           value="<?= (isset($email)) ? $email : $company_info['email']; ?>">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Phone</label>
                                <div class="controls">
                                    <input type="text" name="phone"
                                           value="<?= (isset($phone)) ? $phone : $company_info['phone']; ?>">
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
    <!--
    Clients
    -->


    <!--
    Footer
    -->

</div><!-- /container -->


</body>
</html>
