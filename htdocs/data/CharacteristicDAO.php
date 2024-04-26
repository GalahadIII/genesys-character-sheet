<?php
require_once(__DIR__ . "/model/Characteristic.php");

class CharacteristicDAO { 

    public static function getCharacteristicsByCharacterId($idCharacter){
        require_once(__DIR__ . "/connection.php");
        $database = createPDO();

        $SQL = "SELECT * FROM characteristic WHERE id_character = :id_character";

        $request = $database->prepare($SQL);
        $request->bindValue(':id_character', $idCharacter, PDO::PARAM_INT);
        $success = $request->execute();

        if (!$success) {
            return null;
        }

        $result = $request->fetch(PDO::FETCH_ASSOC);
        $characteristic = new Characteristic($result);

        return $characteristic;
    }

    public static function createCharacteristics($characterId){
        require_once(__DIR__ . "/connection.php");
        $database = createPDO();

        $SQL = "INSERT INTO characteristic (id_character) VALUES (:id_character)";

        $request = $database->prepare($SQL);
        $request->bindValue(':id_character', $characterId, PDO::PARAM_INT);
        $success = $request->execute();

        return $success;
    }

    public static function updateCharacteristic($idCharacter, $brawn, $agility, $intellect, $cunning, $willpower, $presence){
        require_once(__DIR__ . "/connection.php");
        $database = createPDO();

        $SQL = "UPDATE characteristic SET brawn = :brawn, agility = :agility, intellect = :intellect, cunning = :cunning, willpower = :willpower, presence = :presence WHERE id_character = :id_character";

        $request = $database->prepare($SQL);
        $request->bindValue(':id_character', $idCharacter, PDO::PARAM_INT);
        $request->bindValue(':brawn', $brawn, PDO::PARAM_INT);
        $request->bindValue(':agility', $agility, PDO::PARAM_INT);
        $request->bindValue(':intellect', $intellect, PDO::PARAM_INT);
        $request->bindValue(':cunning', $cunning, PDO::PARAM_INT);
        $request->bindValue(':willpower', $willpower, PDO::PARAM_INT);
        $request->bindValue(':presence', $presence, PDO::PARAM_INT);
        $success = $request->execute();

        return $success;
    }
}
