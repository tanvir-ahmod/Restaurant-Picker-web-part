<?php
/**
 * Created by PhpStorm.
 * User: Shoukhin
 * Date: 5/31/2018
 * Time: 10:33 PM
 */
include('connection.php');

$response = array();

//if id is given, only specific restaurant info will be sent=
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $get_restaurant_query = "SELECT * FROM item WHERE companyID ='$id'";
    $result = $connection->query($get_restaurant_query);

    $response['error'] = false;
    $response['message'] = "Successfully got restaurant's products!";
    $response['items'] = array();

    while ($row = $result->fetch_assoc()) {
        array_push($response['items'], $row);
    }

}

else
{
    $response['error'] = true;
    $response['message'] = "Something went wrong! Please try again later";
}

echo json_encode($response);