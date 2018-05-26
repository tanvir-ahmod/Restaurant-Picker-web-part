<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Add Items</title>
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
                <a href="logout.php"><?php if (isset($_SESSION['companyID'])) echo "Logout"; ?>Logout</a>
            </div>
        </div>
    </div>
</div>

<!--
Lower Header Section
-->
<div class="container">
    <!--
    Body Section
    -->
    <div class="row">

        <div class="span12">
            <!--<ul class="breadcrumb">
                <li><a href="index.php">Home</a> <span class="divider">/</span></li>
                <li class="active">Registration</li>
            </ul>-->
            <h3>Add Items</h3>
            <hr class="soft"/>

            <div class="row">
                <div class="span4"></div>
                <div class="span6">
                    <div class="well">
                        <h5>Add Items</h5><br/>
                        Fill all the fields to add a item<br/><br/><br/>
                        <form action="add_item_to_database.php" method="post" enctype="multipart/form-data">
                            <div class="control-group">
                                <label class="control-label">Item Name</label>
                                <div class="controls">
                                    <input type="text" name="item_name">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Price</label>
                                <div class="controls">
                                    <input type="text" name="price">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Description</label>
                                <div class="controls">
                                    <input type="text" name="description">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="inputEmail">Image</label>
                                <div class="controls">
                                    <input type="file" name="fileToUpload" id="fileToUpload">
                                </div>
                            </div>


                            <div class="controls">
                                <button type="submit" name="submit" class="btn block">Add</button>
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
