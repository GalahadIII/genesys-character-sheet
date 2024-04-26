<?php
include_once(__DIR__ . "/model/Character.php");
include_once(__DIR__ . "/model/Characteristic.php");

Class CharacterDAO {
    
    public static function getCharacterById($idCharacter){
        require_once(__DIR__ . "/connection.php");
        $database = createPDO();

        $SQL = "SELECT * FROM player_character WHERE id = :id";

        $request = $database->prepare($SQL);
        $request->bindValue(':id', $idCharacter, PDO::PARAM_INT);
        $success = $request->execute();

        if (!$success) {
            return null;
        }

        $result = $request->fetch(PDO::FETCH_ASSOC);
        $character = new Character($result);

        return $character;
    }

    public static function createCharacter($playerId, $characterName, $skillPreset){
        require_once(__DIR__ . "/connection.php");
        $database = createPDO();

        $SQL = "INSERT INTO player_character (id_player, name, skill_preset) VALUES (:id_player, :name, :skill_preset)";

        $request = $database->prepare($SQL);
        $request->bindValue(':id_player', $playerId, PDO::PARAM_INT);
        $request->bindValue(':name', $characterName, PDO::PARAM_STR);
        $request->bindValue(':skill_preset', $skillPreset, PDO::PARAM_INT);
        $success = $request->execute();

        if ($success) {
            return $database->lastInsertId();
        }

        return null;
    }

    public static function listCharactersByPlayer($playerId){
        require_once(__DIR__ . "/connection.php");
        $database = createPDO();

        $SQL = "SELECT id, name FROM player_character WHERE id_player = :id_player";

        $request = $database->prepare($SQL);
        $request->bindValue(':id_player', $playerId, PDO::PARAM_INT);
        $success = $request->execute();

        if (!$success) {
            return null;
        }

        $results = $request->fetchAll(PDO::FETCH_ASSOC);
        $characters = array();
        foreach ($results as $result) {
            $characters[] = new PlayerCharacter($result);
        }

        return $characters;
    }
}