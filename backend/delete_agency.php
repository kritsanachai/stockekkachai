<?php
include("../backend/connect_db.php");

$id = $_POST['id'];
$result = $conn->query("DELETE FROM agency WHERE id_agency = $id");
if ($result) {
    echo json_encode(1);
    // echo "<script>alert('ลบรายการแล้วเรียบร้อย'); window.location = '../all_product.php'</script>";
} else {
    echo json_encode(0);
    // echo $conn->error;
}



?>