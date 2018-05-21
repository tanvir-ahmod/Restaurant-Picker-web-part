<?php
include('connection.php');
if (isset($_POST['login'])) {


    if (!isset($_POST['email']) || !isset($_POST['password'])) {
        echo "<script>alert('Failed to login! Please fill the fields correctly!')</script>";
        echo '<script>window.location="login.php"</script>';
        //echo "alert";
    }

    $email = $_POST['email'];
    $password = $_POST['password'];

/*//user is super user
    if ($username == 'admin' && $password == 'admin') {
        session_start();
        $_SESSION['user'] = 'admin';
        $_SESSION['admin'] = 1;
        echo "<script>alert('Welcome Admin!')</script>";
        echo '<script>window.location="admin_panel.php"</script>';
    }*/

    $login_query = "SELECT * FROM company WHERE email ='$email' AND password = '$password'";
    $user = $connection->query($login_query);


    if (mysqli_num_rows($user) == 1) {
        session_start();
        $name = $user->fetch_assoc();
        $_SESSION['company'] = $name['name'];
        $_SESSION['id'] = $name['id'];
        echo "<script>alert('Successfully logged in!')</script>";
        echo '<script>window.location="index.php"</script>';
    } else {
        echo "<script>alert('Invalid email or password!')</script>";
        echo '<script>window.location="login.php"</script>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login</title>
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

                <a href="index.php"> <span class="icon-home"></span> Home</a>
                <a href="company_registration.php"><span class="icon-edit"></span> Free Register </a>
                <a href="logout.php"><?php if (isset($_SESSION['user'])) echo "Logout"; ?></a>

            </div>
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
    <div class="navbar">
        <div class="navbar-inner">
            <div class="container">
                <a data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="nav-collapse">
                    <ul class="nav">
                        <li class=""><a href="index.php">Home </a></li>
                    </ul>
                    <form action="search.php" method="post" class="navbar-search pull-right">
                        <input type="text" name="search_name" placeholder="Search" class="search-query span2">
                    </form>
                    <ul class="nav pull-right">
                        <li class="dropdown">
                            <a href="login.php"> Login </a>

                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--
    Body Section
    -->
    <div class="row">

        <div class="span12">
            <ul class="breadcrumb">
                <li><a href="index.php">Home</a> <span class="divider">/</span></li>
                <li class="active">Login</li>
            </ul>
            <h3> Login</h3>
            <hr class="soft"/>

            <div class="row">
                <div class="span4"> &nbsp;</div>
                <div class="span5">
                    <div class="well">
                        <h5>ALREADY REGISTERED ?</h5>
                        <form action="" method="post">
                            <div class="control-group">
                                <label class="control-label" >Email</label>
                                <div class="controls">
                                    <input type="email" name="email" placeholder="E-mail" required>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" >Password</label>
                                <div class="controls">
                                    <input type="password" name="password" placeholder="Password" required>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <button type="submit" name="login" class="defaultBtn">Sign in</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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
