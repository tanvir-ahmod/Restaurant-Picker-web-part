<?php
include('connection.php');

$response = array();

if (!isset($_POST['name']) || !isset($_POST['password']) || !isset($_POST['email']) ||
    !isset($_POST['phone'])
) {
    $response['error'] = true;
    $response['message'] = 'Please fill all fields correctly';
} else {
    $name = $_POST['name'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $user_exist_query = "SELECT * FROM users WHERE email = '$email' OR phone = '$phone'";
    $user_exist = $connection->query($user_exist_query);

    if (mysqli_num_rows($user_exist) > 0) {
        $response['error'] = true;
        $response['message'] = 'Email or phone already used!';
    } else {

        $user_registration_query = "insert into users (name,password,email,phone) 
                              VALUES ('$name','$password','$email','$phone')";

        $connection->query($user_registration_query);

        $insertedID = $connection->insert_id;

        $user = array(
            'id' => $insertedID,
            'name' => $name,
            'email' => $email,
            'phone' => $phone
        );

        $response['error'] = false;
        $response['message'] = "Successfully registered!";
        $response['user'] = $user;

    }


}

echo json_encode($response);