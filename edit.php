<?php
header('Content-type: application/json');
include "connect.php";
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $editInfo = htmlspecialchars(trim($_POST['editInfo']));
    $editId = htmlspecialchars(trim($_POST['editId']));
    $product = $_POST['product'];

    if(isset($editInfo) && !empty($editInfo)){
        if($editInfo == $product){
            $data = array(
                'message' => 'Введите другое слово'
            );
            echo json_encode($data);
        }else{
            mysqli_query($link, "UPDATE product SET product = $editInfo WHERE id = $editId");
            $result = mysqli_query($link, "SELECT product FROM product WHERE id = $editId LIMIT 1");
            if(mysqli_num_rows($result) > 0){
                $rows = mysqli_fetch_assoc($result);
                $data = array(
                    'success' => true,
                    'product' => $rows['product']
                );
                echo json_encode($data);
            }
        }

    }else{
        $data = array(
            'success' => false
        );
        echo json_encode($data);
    }
}