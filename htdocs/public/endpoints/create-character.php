<?php
require_once(__DIR__ . "/../../data/CharacterDAO.php");
require_once(__DIR__ . "/../../data/CharacterSkillDAO.php");
require_once(__DIR__ . "/../../data/CharacteristicDAO.php");
require_once(__DIR__ . "/../../data/SkillPresetDAO.php");

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['player_id'], $_POST['character_name'], $_POST['skill_preset'])) {
        $playerId = $_POST['player_id'];
        $characterName = $_POST['character_name'];
        $skillPreset = $_POST['skill_preset'];

        // Create the character
        $characterId = CharacterDAO::createCharacter($playerId, $characterName, $skillPreset);

        if ($characterId !== null) {
            // Add skills and characteristics for the character
            $skillInPreset = SkillPresetDAO::getSkillsByPreset($skillPreset);
            CharacterSkillDAO::createCharacterSkills($characterId, $skillInPreset);
            CharacteristicDAO::createCharacteristics($characterId);

            echo json_encode(['status' => 'success', 'message' => 'Character created successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to create character']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}