<?php
include '../../config/database.php';

if(isset($_POST['V']) && isset($_POST['I']) && isset($_POST['R']) && isset($_POST['hasil'])){
    $V = $_POST['V'];
    $I = $_POST['I'];
    $R = $_POST['R'];
    $hasil = $_POST['hasil'];

    $stmt = $conn->prepare("INSERT INTO history_ohm (tegangan, arus, resistansi, hasil) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ddds", $V, $I, $R, $hasil);
    $stmt->execute();
    $stmt->close();

    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => "Data tidak lengkap"]);
}
?>
