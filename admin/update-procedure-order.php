<?php

    include("../config/dbconfig.php");

    $data = json_decode(file_get_contents('php://input'), true);

    if ($data) {
        foreach ($data as $item) {
            $id = intval($item['id']);
            $position = intval($item['position']);

            $query = $con->prepare("UPDATE `procedure` SET `order` = ? WHERE `id_procedure` = ?");
            $query->bind_param("ii", $position, $id);
            $query->execute();
        }

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
    
?>