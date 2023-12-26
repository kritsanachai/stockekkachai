<?php
include("connect_db.php");
$id = $_POST['id'];
$name = $_POST['name'];

$UpdatePro = $conn->query("UPDATE agency SET name = '$name' WHERE id_agency = '$id'");
if ($UpdatePro) {
    echo json_decode(1);
} else {
    echo json_decode(0);
}
?>