<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin Panel</title>
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
            <!--<ul class="breadcrumb">
                <li><a href="index.php">Home</a> <span class="divider">/</span></li>
                <li class="active">Registration</li>
            </ul>-->
            <h3>Registration</h3>
            <hr class="soft"/>

            <div class="row">
                <div class="span4"></div>
                <div class="span6">
                    <div class="well">
                        <h5>Add info</h5><br/>
                        Fill all the fields to register<br/><br/><br/>
                        <form action="upload.php" method="post" enctype="multipart/form-data">
                            <div class="control-group">
                                <label class="control-label" >Restaurant Name</label>
                                <div class="controls">
                                    <input type="text" name="restaurant_name">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" >Password</label>
                                <div class="controls">
                                    <input type="password" name="password">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" >Email</label>
                                <div class="controls">
                                    <input type="email" name="email">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" >Phone</label>
                                <div class="controls">
                                    <input type="text" name="phone">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="inputEmail">Image</label>
                                <div class="controls">
                                    <input type="file" name="fileToUpload" id="fileToUpload">
                                </div>
                            </div>


                            <div class="controls">
                                <button type="submit" name="submit" class="btn block">Register</button>
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
