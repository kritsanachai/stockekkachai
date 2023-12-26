<?php
include("connect_db.php");
$id = $_POST['id'];
$password_1 = $_POST['password_1'];
$password_2 = $_POST['password_2'];

// echo json_encode(1);

if ($password_1 != $password_2) {
    echo json_encode(2);
    exit();
    // echo "<script>alert('รหัสผ่านไม่ตรงกัน กรุณากรอกใหม่อีกครั้ง'); window.location = '../frontend/index.php'</script>";
} else {

    $newpassword = md5($password_1);
    $result = $conn->query("UPDATE users SET password = '$newpassword' WHERE user_id = '$id'");
    // $query = $conn->query($sql);
    if ($result) {
        echo json_encode(1);
    } else {
        echo "Error: " . $conn->error;
    }

}

?>