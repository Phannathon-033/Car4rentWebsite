<?php
include 'db.php';

$data = json_decode(file_get_contents("php://input"));

if (
    isset($data->car_id) && isset($data->brand) && isset($data->model) &&
    isset($data->seats) && isset($data->luggage_capacity) && isset($data->wheel_type) &&
    isset($data->price_per_day)
) {
    $car_id = $data->car_id;
    $brand = $data->brand;
    $model = $data->model;
    $seats = $data->seats;
    $luggage_capacity = $data->luggage_capacity;
    $wheel_type = $data->wheel_type;
    $price_per_day = $data->price_per_day;

    $stmt = $conn->prepare("INSERT INTO cars (car_id, brand, model, seats, luggage_capacity, wheel_type, price_per_day) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssisss", $car_id, $brand, $model, $seats, $luggage_capacity, $wheel_type, $price_per_day);

    if ($stmt->execute()) {
        echo json_encode(["message" => "เพิ่มข้อมูลสำเร็จ"]);
    } else {
        echo json_encode(["message" => "เกิดข้อผิดพลาด"]);
    }

    $stmt->close();
} else {
    echo json_encode(["message" => "ข้อมูลไม่ครบ"]);
}


$conn->close();
?>
