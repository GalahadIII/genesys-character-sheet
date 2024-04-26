<?php
require_once(__DIR__ . "/../../data/PresetDAO.php");

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $presets = PresetDAO::listPresets();
    echo json_encode($presets);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
