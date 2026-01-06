<?php
header("Content-Type: application/json; charset=UTF-8");
require_once "db.php";

if (!isset($_GET['id'])) {
    echo json_encode(["error" => "No artwork id"]);
    exit;
}

$id = $_GET['id'];

$sql = "SELECT * FROM artworks WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(["error" => "Artwork not found"]);
} else {
    echo json_encode($result->fetch_assoc());
}