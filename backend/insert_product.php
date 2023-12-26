<?php 
    include("../backend/connect_db.php");

    $name = $_POST['name'];
    $qty = $_POST['qty'];
    $price = $_POST['price'];
    // $img = $_FILES['img'];


    // $allow = array('jpg', 'jpeg', 'png'); //นามสกุลที่สามารถ Upload ได้
    // $extension = explode(".", $img['name'] ); //แยกชื่อจาก
    // $fileActExt = strtolower(end($extension)); // ตัวพิมพ์เล็ก
    // $fileNew = rand() . "." . $fileActExt;
    // $filePath = "../frontend/upload/".$fileNew;

    

    // if (in_array($fileActExt, $allow)) {
    //     if($img['size'] > 0 && $img['error'] == 0){
    //         if(move_uploaded_file($img['tmp_name'], $filePath)){
        $nameRe = $conn->query("SELECT * FROM products WHERE name = '$name'");
        $nameRow = $nameRe->num_rows;
        if($nameRow > 0){
            echo json_encode(2);
            exit();
        }
        else{
            $result = $conn->query("INSERT INTO products (name,qty,price) VALUES ('$name','$qty','$price')");
            if($result) {
                echo json_encode(1);
            }else{
                echo json_encode(0);
            }
        }
    //         }
    //     }
    // }

    
?>