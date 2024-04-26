<?php
include_once(__DIR__ . "/model/Skill.php");

class CharacterSkillDAO { 

    public static function getSkillsByCharacterId($idCharacter){
        require_once(__DIR__ . "/connection.php");
        $database = createPDO();

        $SQL = "SELECT character_skill.rank AS rank, character_skill.career AS career, character_skill.characteristic AS characteristic, skill.id AS id, skill.name AS name, skill.type as type FROM character_skill JOIN skill ON character_skill.id_skill = skill.id WHERE character_skill.id_character = :id_character";

        $request = $database->prepare($SQL);
        $request->bindValue(':id_character', $idCharacter, PDO::PARAM_INT);
        $success = $request->execute();

        if (!$success) {
            return null;
        }

        $results = $request->fetchAll(PDO::FETCH_ASSOC);
        $skills = array();
        foreach ($results as $result) {
            $skills[] = new Skill($result);
        }

        return $skills;
    }

    public static function createCharacterSkills($characterId, $skillsInPreset){
        require_once(__DIR__ . "/connection.php");
        $database = createPDO();

        // For each skill, create an entry in the character_skill table
        foreach ($skillsInPreset as $skill) {
            $SQL = "INSERT INTO character_skill (id_character, id_skill, characteristic) VALUES (:id_character, :id_skill, :characteristic)";
            $request = $database->prepare($SQL);
            $request->bindValue(':id_character', $characterId, PDO::PARAM_INT);
            $request->bindValue(':id_skill', $skill->id, PDO::PARAM_INT);
            $request->bindValue(':characteristic', $skill->characteristic, PDO::PARAM_STR);
            $success = $request->execute();

            if (!$success) {
                return false;
            }
        }
        return true;
    }

    public static function updateSkill($idCharacter, $idSkill, $rank, $career, $characteristic){
        require_once(__DIR__ . "/connection.php");
        $database = createPDO();

        $SQL = "UPDATE character_skill SET rank = :rank, career = :career, characteristic = :characteristic WHERE id_character = :id_character AND id_skill = :id_skill";

        $request = $database->prepare($SQL);
        $request->bindValue(':id_character', $idCharacter, PDO::PARAM_INT);
        $request->bindValue(':id_skill', $idSkill, PDO::PARAM_INT);
        $request->bindValue(':rank', $rank, PDO::PARAM_INT);
        $request->bindValue(':career', $career, PDO::PARAM_BOOL);
        $request->bindValue(':characteristic', $characteristic, PDO::PARAM_STRING);
        $success = $request->execute();

        return $success;
    }
}
