<?php
    include("connect_db.php");
    $id = $_POST['id'];
    $code_user = $_POST['code_user'];
    $fullname = $_POST['fullname'];
    $tel = $_POST['tel'];
    $id_agency = $_POST['id_agency'];

    
        $UpdatePro = $conn->query("UPDATE users SET code_user = '$code_user', fullname = '$fullname', tel = '$tel' , id_agency = '$id_agency'  WHERE user_id = '$id'");
        if ($UpdatePro) {
            echo json_decode(1);
        } else {
            echo json_decode(0);
        }
    
?>