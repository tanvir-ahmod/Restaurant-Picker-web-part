<?php
include('connection.php');

$response = array();

//if id is given, only specific restaurant info will be sent
//echo $_GET['id'];
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $get_restaurant_query = "SELECT * FROM company WHERE id ='$id'";
    $result = $connection->query($get_restaurant_query)->fetch_assoc();

    $restaurant = array(
        'id' => $id,
        'name' => $result['name'],
        'phone' => $result['phone'],
        'image' => $result['image']
    );

    $response['error'] = false;
    $response['message'] = "Successfully got restaurant info!";
    $response['restaurant'] = $restaurant;


} else {
    $all_restaurant_query = "SELECT * FROM company";
    $result = $connection->query($all_restaurant_query);

    $response['error'] = false;
    $response['message'] = "Successfully got restaurants info!";
    $response['restaurant'] = array();

    while ($row = $result->fetch_assoc()) {
        //print_r( $row);

        array_push($response['restaurant'], $row);
    }


}


echo json_encode($response);