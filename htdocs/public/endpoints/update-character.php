<?php
require_once(__DIR__ . "/../../data/CharacterDAO.php");
require_once(__DIR__ . "/../../data/CharacteristicDAO.php");
require_once(__DIR__ . "/../../data/CharacterSkillDAO.php");

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['id'], $data['name'], $data['archetype'], $data['career'], $data['skill_preset'], $data['strain'], $data['strain_threshold'], $data['wound'], $data['wound_threshold'], $data['defense_melee'], $data['defense_ranged'], $data['soak'], $data['xp_total'], $data['xp_available'], $data['dice_pool'])) {
        $id = $data['id'];
        $name = $data['name'];
        $archetype = $data['archetype'];
        $career = $data['career'];
        $skillPreset = $data['skill_preset'];
        $strain = $data['strain'];
        $strainThreshold = $data['strain_threshold'];
        $wound = $data['wound'];
        $woundThreshold = $data['wound_threshold'];
        $defenseMelee = $data['defense_melee'];
        $defenseRanged = $data['defense_ranged'];
        $soak = $data['soak'];
        $xpTotal = $data['xp_total'];
        $xpAvailable = $data['xp_available'];
        $dicePool = $data['dice_pool'];

        // Update the character
        $success = CharacterDAO::updateCharacter($id, $name, $archetype, $career, $skillPreset, $strain, $strainThreshold, $wound, $woundThreshold, $defenseMelee, $defenseRanged, $soak, $xpTotal, $xpAvailable, $dicePool);

        if ($success) {
            echo json_encode(['status' => 'success', 'message' => 'Character updated successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update character']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}