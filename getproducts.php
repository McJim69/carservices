<?php
    require("connect.php");

    $id = $_GET["id"];
    $select = $pdo->prepare("SELECT * FROM products WHERE product_id = :tranid ");
    $select->bindParam(":tranid", $id);
    $select->execute();
    $row = $select->fetch(PDO::FETCH_ASSOC);
    $response=$row;
    header('Content-Type: application/json');
    echo json_encode($response);
?>