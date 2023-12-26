<?php
include("connect_db.php");
    $code_user = $_POST['code_user'];
    $password_1 = $_POST['password_1'];
    $password_2 = $_POST['password_2'];
    $fullname = $_POST['fullname'];
    $tel = $_POST['tel'];
    $id_agency = $_POST['id_agency'];
    $status = "user";

    // echo json_encode(1);

    if ($password_1 != $password_2) {
        echo json_encode(2);
        exit();
        // echo "<script>alert('รหัสผ่านไม่ตรงกัน กรุณากรอกใหม่อีกครั้ง'); window.location = '../frontend/index.php'</script>";
    } 
    else {
        $result = $conn->query("SELECT * FROM users WHERE code_user = '$code_user'");
        if ($result->num_rows > 0) {
            echo json_encode(0);
            exit();
        } else {
            $newpassword = md5($password_1);
            $result = $conn->query("INSERT INTO users (code_user, fullname, tel, id_agency , password, status) VALUES ('$code_user','$fullname', '$tel', '$id_agency', '$newpassword', '$status')");
            // $query = $conn->query($sql);
            if ($result) {
                echo json_encode(1);
            } else {
                echo "Error: " . $conn->error;
            }
        }
    }

?>