<?php 
    include("connect_db.php");
    session_start();
    $id_user = $_SESSION['user_login'];
    $cartResult = $conn->query("SELECT * FROM cart WHERE id_user = '$id_user'");

    
    $total = $_POST['total'];
    date_default_timezone_set('Asia/Bangkok');
    $date = date('d-m-Y H:i:s');
    // $slipMoneyName = $_FILES['slipMoney']['name'];
    // $slipMoneyType = $_FILES['slipMoney']['tmp_name'];
    // $folder = '../frontend/slipMoney/';
    // $location = $folder . $slipMoneyName;
    // move_uploaded_file($slipMoneyType , $location);

    // echo json_encode($date);
    $cartReQ = $conn->query("SELECT * FROM cart WHERE id_user = $id_user");
    while($dataCart = $cartReQ->fetch_assoc()){
        $qtyCart = $dataCart['qty'];
        $idProCart = $dataCart['id_product'];
        $chackQtyRe = $conn->query("SELECT * FROM products WHERE id_product ='$idProCart'");
        $dataProQty = $chackQtyRe->fetch_assoc();
        $qtyPro = $dataProQty['qty'];
        if($qtyCart > $qtyPro){
            echo json_encode(2);
            exit();
        }
    }
    
    $inOrder = $conn->query("INSERT INTO orders (order_date,id_user,total) VALUES ('$date','$id_user','$total')");
    $idOrder = mysqli_insert_id($conn);

    
    while($data = $cartResult->fetch_assoc()){
        $idPro = $data['id_product'];
        $qty = $data['qty'];
        $inOrderDetail = $conn->query("INSERT INTO order_details (id_order,product_id,qty) VALUES ('$idOrder','$idPro','$qty')");
    }

    $cartDel = $conn->query("DELETE FROM cart WHERE id_user = '$id_user'");



    // $ordeRe = $conn->query("SELECT * FROM order WHERE id_user = '$id_user'");
    // $dataOr = $ordeRe->fetch_assoc();
    // $id_order = $dataOr['id_order'];

    $reDetail = $conn->query("SELECT * FROM order_details WHERE id_order = '$idOrder'");
    while($dataDetail = $reDetail->fetch_assoc()){
        $idProduct = $dataDetail['product_id'];
        $qtyDetail = $dataDetail['qty'];
        
        $upRe = $conn->query("UPDATE products SET qty = qty - '$qtyDetail' WHERE id_product = '$idProduct'");
    }

    echo json_encode(1);
    

    
    
?>