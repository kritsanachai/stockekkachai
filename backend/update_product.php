<?php
include("connect_db.php");
$id = $_POST['id'];
$name = $_POST['name'];
$qty = $_POST['qty'];
$price = $_POST['price'];
// 
// if (!empty($_POST['id'])) {
//     $id = $_POST['id'];
//     $query_pro = $conn->query("SELECT * FROM products WHERE id_product = '$id'");
//     $pro = $query_pro->fetch_array();
//     @unlink('../frontend/upload/' . $pro['img']);
//     if (isset($_FILES['img'])) {
//         $img = $_FILES['img'];
//         $allow = array('jpg', 'jpeg', 'png'); //นามสกุลที่สามารถ Upload ได้
//         $extension = explode(".", $img['name']); //แยกชื่อจาก
//         $fileActExt = strtolower(end($extension)); // ตัวพิมพ์เล็ก
//         $fileNew = rand() . "." . $fileActExt;
//         $filePath = "../frontend/upload/" . $fileNew;
//         if (in_array($fileActExt, $allow)) {
//             if ($img['size'] > 0 && $img['error'] == 0) {
//                 if (move_uploaded_file($img['tmp_name'], $filePath)) {
//                     $imgUpdeate = $conn->query("UPDATE products SET img = '$fileNew' WHERE id_product = '$id'");
//                 }
//             }
//         }
//     }
// }

// echo json_decode(0);
$UpdatePro = $conn->query("UPDATE products SET name = '$name', price='$price', qty = '$qty' WHERE id_product = '$id'");
if ($UpdatePro) {
    echo json_decode(1);
} else {
    echo json_decode(0);
}
?>