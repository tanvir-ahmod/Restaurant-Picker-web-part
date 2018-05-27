<?php
include('connection.php');

if (!isset($_POST['name']) || !isset($_POST['password']) || !isset($_POST['email']) ||
    !isset($_POST['phone'])
) {
    echo "Please fill all fields correctly!";
} else {
    $name = $_POST['name'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $user_registration_query = "insert into users (name,password,email,phone) 
                              VALUES ('$name','$password','$email','$phone')";

    $isInserted = $connection->query($user_registration_query);

    if ($isInserted) {
        echo "Successfully registered!";
    } else
        echo "Something went wrong! Please try again";
}