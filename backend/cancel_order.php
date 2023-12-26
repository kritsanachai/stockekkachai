<?php 
    include("connect_db.php");
    $idOrder = $_POST['idOrder'];
    $note = $_POST['note'];
    $cancel = "ยกเลิก";

    //ลบจำนวนวัสดุในสต๊อก
    $reDetail = $conn->query("SELECT * FROM order_details WHERE id_order = '$idOrder'");
    while($dataDetail = $reDetail->fetch_assoc()){
        $idProduct = $dataDetail['product_id'];
        $qtyDetail = $dataDetail['qty'];
        
        $upRe = $conn->query("UPDATE products SET qty = qty + '$qtyDetail' WHERE id_product = '$idProduct'");
    }
    
    $reOrder = $conn->query("UPDATE orders SET status = '$cancel', note = '$note' WHERE id_order = '$idOrder'");
    if($reOrder){
        echo json_encode(1);
    }else{  
        echo json_encode(0);
    }
?>