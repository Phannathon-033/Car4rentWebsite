<?php
$host = "localhost";
$user = "root"; // ค่าเริ่มต้นของ XAMPP
$pass = ""; // ค่าเริ่มต้นของ XAMPP (ว่างเปล่า)
$db = "car_db";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("เชื่อมต่อฐานข้อมูลล้มเหลว: " . $conn->connect_error);
}
?>