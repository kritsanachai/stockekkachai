<?php
include("../backend/connect_db.php");

$name = $_POST['name'];

$result = $conn->query("INSERT INTO agency (name) VALUES ('$name')");
if ($result) {
    echo json_encode(1);
} else {
    echo json_encode(0);
}



?>