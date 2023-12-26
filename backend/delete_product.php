<?php 
    include("../backend/connect_db.php");
    if(!empty($_POST['id'])){
        $id = $_POST['id'];
        $query_pro = $conn->query("SELECT * FROM products WHERE id_product = '$id'");
        $pro = $query_pro->fetch_array();
        @unlink('../frontend/upload/' . $pro['img']);
        // // echo $pro['img'];
        // echo json_encode(1);
        $result = $conn->query("DELETE FROM products WHERE id_product = $id");
        if($result){
            echo json_encode(1);
            // echo "<script>alert('ลบรายการแล้วเรียบร้อย'); window.location = '../all_product.php'</script>";
        }else{
            echo json_encode(0);
            // echo $conn->error;
        }
    }

    
?>