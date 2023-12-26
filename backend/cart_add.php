<?php 
    include("connect_db.php");
    session_start();
    $id_user = $_SESSION['user_login'];
    $id_product = $_POST['id_product'];
    $qty = $_POST['qty'];

    $sqlCart = $conn->query("SELECT * FROM cart WHERE id_user = '$id_user' AND id_product = '$id_product'");
    $dataCart = $sqlCart->fetch_assoc();
    $sqlPro = $conn->query("SELECT * FROM products WHERE id_product = '$id_product'");
    $dataPro = $sqlPro->fetch_assoc();



        $price = $dataPro['price'];
        if($sqlCart->num_rows > 0){
            $id_cart = $dataCart['id_cart'];
            $qtySum = $dataCart['qty']+1;
            $upCart = $conn->query("UPDATE cart SET qty = '$qtySum' WHERE id_cart = '$id_cart'");
            echo json_decode(1);
        }else{
            $addCart = $conn->query("INSERT INTO cart (id_user,id_product,qty) VALUES ('$id_user','$id_product','$qty')");
            echo json_decode(1);
        }
    // echo $user_id . $product_id . $qty;
    
?>