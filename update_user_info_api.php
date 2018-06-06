<?php
/**
 * Created by PhpStorm.
 * User: Shoukhin
 * Date: 6/6/2018
 * Time: 11:58 AM
 */

include('connection.php');

$response = array();

if (!isset($_POST['id'])
) {
    $response['error'] = true;
    $response['message'] = 'Something went wrong! Please try again later.';
} else {
    $id = $_POST['id'];

    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        $update_email_query = "UPDATE users SET email = '$email' WHERE id = '$id'";
        $connection->query($update_email_query);
    }
    if (isset($_POST['password'])) {
        $password = $_POST['password'];
        $update_password_query = "UPDATE users SET password = '$password' WHERE id = '$id'";
        $connection->query($update_password_query);
    }
    if (isset($_POST['phone'])) {
        $phone = $_POST['phone'];
        $update_phone_query = "UPDATE users SET phone = '$phone' WHERE id = '$id'";
        $connection->query($update_phone_query);
    }

    $updated_user_query = "SELECT * FROM users WHERE id ='$id'";
    $updated_user = $connection->query($updated_user_query);

    $logged_user = $updated_user->fetch_assoc();
    $name = $logged_user['name'];
    $email = $logged_user['email'];
    $phone = $logged_user['phone'];
    $id = $logged_user['id'];
    $user = array(
        'id' => $id,
        'name' => $name,
        'email' => $email,
        'phone' => $phone
    );

    $response['error'] = false;
    $response['message'] = 'Successfully logged in!';
    $response['user'] = $user;

}

echo json_encode($response);