<?php
include_once(__DIR__ . "/model/Skill.php");

class SkillPresetDAO { 
    
    public static function getSkillsByPreset($presetId){
        require_once(__DIR__ . "/connection.php");
        $database = createPDO();

        $SQL = "SELECT skill.* FROM skill_preset JOIN skill ON skill_preset.id_skill = skill.id WHERE skill_preset.id_preset = :id_preset";

        $request = $database->prepare($SQL);
        $request->bindValue(':id_preset', $presetId, PDO::PARAM_INT);
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

    public static function addSkillToPreset($presetId, $skillId){
        require_once(__DIR__ . "/connection.php");
        $database = createPDO();

        $SQL = "INSERT INTO skill_preset (id_preset, id_skill) VALUES (:id_preset, :id_skill)";

        $request = $database->prepare($SQL);
        $request->bindValue(':id_preset', $presetId, PDO::PARAM_INT);
        $request->bindValue(':id_skill', $skillId, PDO::PARAM_INT);
        $success = $request->execute();

        return $success;
    }
}
