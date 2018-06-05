<?php
/**
 * Created by PhpStorm.
 * User: Shoukhin
 * Date: 6/5/2018
 * Time: 7:19 PM
 */

include('connection.php');

$response = array();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $get_restaurant_query = "SELECT * FROM orders WHERE user_id = '$id'";
    $result = $connection->query($get_restaurant_query);

    $response['error'] = false;
    $response['message'] = "User order history reached!";
    $response['history'] = array();

    while ($row = $result->fetch_assoc()) {

        $item_id = $row['item_id'];
        $amount = $row['amount'];

        $get_price_query = "SELECT price FROM item WHERE id = '$item_id'";
        $price = $connection->query($get_price_query) ->fetch_assoc();
        $price['price'] = $price['price'] * $amount;
        $row['price'] = $price['price'];
        array_push($response['history'], $row);

    }

} else {
    $response['error'] = true;
    $response['message'] = "Something went wrong! Please try again later";
}

echo json_encode($response);