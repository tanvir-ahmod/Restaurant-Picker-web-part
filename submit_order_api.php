<?php
include('connection.php');

$response = array();

if (!isset($_POST['item_id']) || !isset($_POST['user_id']) || !isset($_POST['company_id'])
    || !isset($_POST['amount']) || !isset($_POST['phone']) || !isset($_POST['location'])
) {
    $response['error'] = true;
    $response['message'] = 'Something went wrong! Please Try again';
} else {
    $item_id = $_POST['item_id'];
    $user_id = $_POST['user_id'];
    $company_id = $_POST['company_id'];
    $amount = $_POST['amount'];
    $phone = $_POST['phone'];
    $location = $_POST['location'];

    $submit_order_query = "insert into orders (item_id,user_id,company_id,amount,phone,location) 
                              VALUES ('$item_id','$user_id','$company_id','$amount','$phone','$location')";
    $isInserted = $connection->query($submit_order_query);
    if ($isInserted) {
        $response['error'] = false;
        $response['message'] = 'Placed order successfully! Please wait for our response';
    } else {
        $response['error'] = true;
        $response['message'] = 'Something went wrong! Please Try again';
    }
}

echo json_encode($response);