<?php
header("Content-Type: application/json");
include "db.php"; // ไฟล์เชื่อมต่อฐานข้อมูล

$data = json_decode(file_get_contents("php://input"));

if (isset($data->car_id)) {
    $car_id = $conn->real_escape_string($data->car_id);

    $sql = "DELETE FROM cars WHERE car_id = '$car_id'";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "ลบรถสำเร็จ"]);
    } else {
        echo json_encode(["message" => "เกิดข้อผิดพลาดในการลบ: " . $conn->error]);
    }
} else {
    echo json_encode(["message" => "ไม่มีรหัสรถ"]);
}

$conn->close();
?>