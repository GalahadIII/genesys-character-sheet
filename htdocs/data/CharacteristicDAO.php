<?php
require_once(__DIR__ . "/model/PlayerCharacter.php");
require_once(__DIR__ . "/model/Characteristic.php");

Class CharacteristicDAO {

    public static function getCharacteristicByCharacter($idPlayerCharacter){
        require_once(__DIR__ . "/connection.php");
        $database = createPDO();

        $SQL = "SELECT * FROM characteristic WHERE id_player_character = :id_player_character";

        $request = $database->prepare($SQL);
        $request->bindValue(':id_player_character', $idPlayerCharacter, PDO::PARAM_STR);
        $success = $request->execute();

        if (!$success) {
            return null;
        }

        $result = $request->fetch(PDO::FETCH_ASSOC);
        $characteristic = new Characteristic($result);

        return $characteristic;
    }
}