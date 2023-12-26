<?php 
    include("connect_db.php");
    session_start();
    $id_user = $_SESSION['user_login'];
    $id_product = $_POST['id_product'];
    $qty = $_POST['qty'];

    $sqlCart = $conn->query("SELECT * FROM cart WHERE id_user = '$id_user' AND id_product = '$id_product'");
    $dataCart = $sqlCart->fetch_assoc();
    $id_cart = $dataCart['id_cart'];
    $sqlPro = $conn->query("SELECT * FROM products WHERE id_product = '$id_product'");
    $dataPro = $sqlPro->fetch_assoc();

    $sqlUp = $conn->query("UPDATE cart SET  qty = '$qty' WHERE id_cart = '$id_cart'");



    echo json_encode(1);
?>