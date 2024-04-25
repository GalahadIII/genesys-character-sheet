<?php
require_once(__DIR__ . "/model/PlayerCharacter.php");
require_once(__DIR__ . "/model/Characteristic.php");

Class CharacterDAO {
    public static function getCharactersByPlayerName($playerName){
        require_once(__DIR__ . "/connection.php");
        $database = createPDO();


        $SQL = "SELECT name FROM player_character WHERE player_name LIKE(:player_name)";
        
        $request = $database->prepare($SQL);
        $request->bindValue(":player_name", $playerName, PDO::PARAM_STR);
        $success = $request->execute();

        if (!$success) {
            return null;
        }

        $result = $request->fetchAll(PDO::FETCH_ASSOC);

        $characterFiltered = array();
        foreach ($result as $character) {
            $characterFiltered[] = new PlayerCharacter($character);
        }

        return $characterFiltered;
    }

    public static function getCharacterFromPlayer($playerName, $characterName){
        require_once(__DIR__ . "/connection.php");
        $database = createPDO();

        $SQL = "SELECT * FROM player_character WHERE player_name LIKE(:player_name) AND name LIKE(:name)";

        $request = $database->prepare($SQL);
        $request->bindValue(":player_name", $playerName, PDO::PARAM_STR);
        $request->bindValue(":name", $characterName, PDO::PARAM_STR);
        $success = $request->execute();

        if (!$success) {
            return null;
        }

        $result = $request->fetch(PDO::FETCH_ASSOC);
        $character = new PlayerCharacter($result);

        return $character;
    }
}