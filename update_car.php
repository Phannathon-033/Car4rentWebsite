<?php
include 'db.php';

header("Content-Type: application/json; charset=UTF-8");

$data = json_decode(file_get_contents("php://input"), true);

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($data)) {
    $car_id = $data["car_id"];
    $brand = $data["brand"];
    $model = $data["model"];
    $seats = $data["seats"];
    $luggage_capacity = $data["luggage_capacity"];
    $wheel_type = $data["wheel_type"];
    $price_per_day = $data["price_per_day"];

    $sql = "UPDATE cars SET brand=?, model=?, seats=?, luggage_capacity=?, wheel_type=?, price_per_day=? WHERE car_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiiiss", $brand, $model, $seats, $luggage_capacity, $wheel_type, $price_per_day, $car_id);

    if ($stmt->execute()) {
        echo json_encode(["message" => "อัปเดตข้อมูลสำเร็จ"]);
    } else {
        echo json_encode(["error" => "อัปเดตข้อมูลล้มเหลว"]);
    }

    $stmt->close();
}

$conn->close();
?>
