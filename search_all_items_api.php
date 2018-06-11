<?php
/**
 * Created by PhpStorm.
 * User: Shoukhin
 * Date: 6/1/2018
 * Time: 3:50 PM
 */


include('connection.php');

$response = array();

if (isset($_GET['search_key'])) {
    $name = $_GET['search_key'];
    $get_restaurant_query = "SELECT * FROM item WHERE item_name LIKE '%$name%'";
    $result = $connection->query($get_restaurant_query);

    $response['error'] = false;
    $response['message'] = "Successfully got restaurant's products!";
    $response['items'] = array();

    while ($row = $result->fetch_assoc()) {
        //Getting restaurant name from id
        $restaurant_id = $row['companyID'];
        $get_restaurant_name = "SELECT name FROM company WHERE id = '$restaurant_id'";
        $restaurant_name = $connection->query($get_restaurant_name)->fetch_assoc();

        $row['restaurant_name'] = $restaurant_name['name'];
        array_push($response['items'], $row);
    }

} else {
    $response['error'] = true;
    $response['message'] = "Something went wrong! Please try again later";
}

echo json_encode($response);