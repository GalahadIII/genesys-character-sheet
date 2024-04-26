<?php
require_once(__DIR__ . "/../../data/CharacterDAO.php");
require_once(__DIR__ . "/../../data/CharacterSkillDAO.php");
require_once(__DIR__ . "/../../data/CharacteristicDAO.php");

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $idCharacter = $_GET['id'];

        // Get the character
        $character = CharacterDAO::getCharacterById($idCharacter);

        // Get the characteristics of the character
        $characteristics = CharacteristicDAO::getCharacteristicsByCharacterId($idCharacter);

        // Get the skills of the character
        $skills = CharacterSkillDAO::getSkillsByCharacterId($idCharacter);

        $character->skills = $skills;
        $character->characteristics = $characteristics; 

        // Combine all the data into one array
        // $characterData = array(
        //     'character' => $character,
        //     'characteristics' => $characteristics,
        //     'skills' => $skills
        // );

        echo json_encode($character);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
