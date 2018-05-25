<?php
session_start();
include('connection.php');

//admin authentication
/*if (!isset($_SESSION['user']) || !isset($_SESSION['admin'])) {
    echo "<script>alert('Please login to continue!')</script>";
    echo '<script>window.location="login.php"</script>';
} else if ($_SESSION['admin'] == 0) {
    echo "<script>alert('Please login to continue')</script>";
    echo '<script>window.location="login.php"</script>';
}*/

if (!isset($_GET['id'])) {
    header('location:index.php');
    exit();
}

$id = $_GET['id'];
$delete_query = "delete from item where id = '$id'";

$connection->query($delete_query);
echo "<script>alert('Deleted item Successfully')</script>";
echo '<script>window.location="index.php"</script>';