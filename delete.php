<?php
header('Content-type: application/json');
include "connect.php";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $deleteId = $_POST['deleteId'];

    if(isset($deleteId) && !empty($deleteId)){
        mysqli_query($link, "DELETE FROM `product` WHERE id = '$deleteId'");
        $data = array(
            'delete' => true
        );

        echo json_encode($data);
    }
}