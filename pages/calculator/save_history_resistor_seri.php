<?php
include '../../config/database.php';

if(isset($_POST['resistors']) && isset($_POST['total'])){
    $resistors = $_POST['resistors']; // format: "100,200,300"
    $total = $_POST['total'];

    $stmt = $conn->prepare("INSERT INTO history_resistor_seri (resistor_values, total_resistance) VALUES (?, ?)");
    $stmt->bind_param("sd", $resistors, $total);
    if($stmt->execute()){
        echo json_encode(["status"=>"success"]);
    } else {
        echo json_encode(["status"=>"error","message"=>$stmt->error]);
    }
    $stmt->close();
} else {
    echo json_encode(["status"=>"error","message"=>"Data tidak lengkap"]);
}
?>
