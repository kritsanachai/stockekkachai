<?php 
    include("../backend/connect_db.php");
        $id_cart = $_POST['id_cart'];
        $result = $conn->query("DELETE FROM cart WHERE id_cart = $id_cart");
        if($result){
            echo json_encode(1);
        }else{
            echo json_encode(0);
        }
?>