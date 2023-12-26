<?php
include("connect_db.php");
session_start();
$id = $_SESSION['user_login'];
$password_0 = $_POST['password_0'];
$password_1 = $_POST['password_1'];
$password_2 = $_POST['password_2'];

$checkPsss = md5($password_0);
$checkPassRe = $conn->query("SELECT * FROM users WHERE user_id = '$id' AND password = '$checkPsss'");
$row = $checkPassRe->num_rows;

// echo json_encode($row);
if ($row == 1) {
    // echo json_encode(2);
    if ($password_1 == $password_2) {
        $newpassword = md5($password_1);
        $result = $conn->query("UPDATE users SET password = '$newpassword' WHERE user_id = '$id'");
        // $query = $conn->query($sql);
        if ($result) {
            echo json_encode(1);
        } else {
            echo "Error: " . $conn->error;
        }
    }
    else{
        echo json_encode(2);
    }
} else {
    echo json_encode(3);
}


?>