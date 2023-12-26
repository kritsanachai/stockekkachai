<?php 
    include("connect_db.php");
    $idOrder = $_POST['idOrder'];
    $approve = "อนุมัติแล้ว";

    

    //อัพเดทสถานะของรายการเบิก
    $reOrder = $conn->query("UPDATE orders SET status = '$approve' WHERE id_order = '$idOrder'");
    if($reOrder){
        echo json_encode(1);
    }else{  
        echo json_encode(0);
    }
?>