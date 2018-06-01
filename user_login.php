<?php
include('connection.php');

$response = array();

if (!isset($_POST['email']) || !isset($_POST['password'])
) {
    $response['error'] = true;
    $response['message'] = 'Please fill all fields correctly';
} else {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $login_query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $temp_user = $connection->query($login_query);

    if ( mysqli_num_rows($temp_user) == 1) {
        $logged_user = $temp_user ->fetch_assoc();
        $name = $logged_user['name'];
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

    } else {

        $response['error'] = true;
        $response['message'] = "Invalid Email or Password!";

    }


}

echo json_encode($response);