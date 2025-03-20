<?php
include 'db.php';

// ตั้งค่าให้ Response เป็น JSON
header("Content-Type: application/json; charset=UTF-8");

if (isset($_GET['car_id'])) {
    // ดึงข้อมูลเฉพาะรถที่ต้องการ
    $car_id = $_GET['car_id'];
    $stmt = $conn->prepare("SELECT * FROM cars WHERE car_id = ?");
    $stmt->bind_param("i", $car_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $car = $result->fetch_assoc();

    if ($car) {
        echo json_encode($car);
    } else {
        echo json_encode(["error" => "ไม่พบข้อมูลรถ"]);
    }

    $stmt->close();
} else {
    // ดึงข้อมูลรถทั้งหมด
    $sql = "SELECT * FROM cars";
    $result = $conn->query($sql);

    $cars = [];
    while ($row = $result->fetch_assoc()) {
        $cars[] = $row;
    }

    echo json_encode($cars);
}

$conn->close();
?>
