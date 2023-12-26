<?php
include("connect_db.php");
session_start();
$id = $_SESSION['user_login'];
$fullname = $_POST['fullname'];
$tel = $_POST['tel'];

$UpdatePro = $conn->query("UPDATE users SET fullname = '$fullname', tel = '$tel' WHERE user_id = '$id'");
if ($UpdatePro) {
    echo json_decode(1);
} else {
    echo json_decode(0);
}

?>