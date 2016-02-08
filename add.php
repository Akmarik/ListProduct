<?php
header('Content-type: application/json');
include "connect.php";
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $product = htmlspecialchars(trim($_POST['product']));
    if(isset($product) && !empty($product)){
        $result = mysqli_query($link, "SELECT id FROM `product` WHERE product = $product LIMIT 1");

        if(mysqli_num_rows($result) > 0){
            $data = array(
                'success' => false
            );

            echo json_encode($data);
        }else{
            mysqli_query($link, "INSERT INTO product(`product`) VALUES ('$product') ");
            $res = mysqli_query($link, "SELECT id, product FROM `product` ORDER BY id DESC LIMIT 0,1");

            if($row = mysqli_fetch_assoc($res)){
                $data = array(
                    'success' => true,
                    'id' => $row['id'],
                    'product' => $row['product']
                );
                echo json_encode($data);
            }else{
                $data = array(
                    'error' => true
                );
                echo json_encode($data);
            }

        }

    }
}