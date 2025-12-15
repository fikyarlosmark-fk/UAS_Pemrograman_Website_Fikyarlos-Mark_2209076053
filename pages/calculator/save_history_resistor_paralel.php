<?php
include '../../config/database.php';

if(isset($_POST['resistors']) && isset($_POST['total'])){
    $resistors = $_POST['resistors']; // contoh: "10,20,30"
    $total = $_POST['total'];

    $stmt = $conn->prepare("INSERT INTO history_resistor_paralel (resistors, total) VALUES (?, ?)");
    $stmt->bind_param("sd", $resistors, $total);
    $stmt->execute();
    $stmt->close();

    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => "Data tidak lengkap"]);
}
?>
