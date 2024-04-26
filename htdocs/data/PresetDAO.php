<?php
include_once(__DIR__ . "/model/Preset.php");
include_once(__DIR__ . "/model/Skill.php");

Class PresetDAO {

    public static function listPresets(){
        require_once(__DIR__ . "/connection.php");
        $database = createPDO();

        $SQL = "SELECT * FROM preset";

        $request = $database->prepare($SQL);
        $success = $request->execute();

        if (!$success) {
            return null;
        }

        $results = $request->fetchAll(PDO::FETCH_ASSOC);
        $presets = array();
        foreach ($results as $result) {
            $presets[] = new Preset($result);
        }

        return $presets;
    }

    public static function createPreset($presetName){
        require_once(__DIR__ . "/connection.php");
        $database = createPDO();

        $SQL = "INSERT INTO preset (name) VALUES (:preset_name)";
        
        $request = $database->prepare($SQL);
        $request->bindValue(":preset_name", $presetName, PDO::PARAM_STR);
    
        $success = $request->execute();
    
        if ($success) {
            return $database->lastInsertId();
        } else {
            return false;
        }
    }

    public static function getSkillTypesInPreset($presetId) {
        require_once(__DIR__ . "/connection.php");
        $database = createPDO();

        $SQL = "SELECT DISTINCT skill.type FROM skill 
                JOIN skill_preset ON skill.id = skill_preset.id_skill 
                WHERE skill_preset.id_preset = :id_preset";
        $request = $database->prepare($SQL);
        $request->bindParam(':id_preset', $presetId);
        $success = $request->execute();
        $types = $request->fetchAll(PDO::FETCH_COLUMN);

        return $types;
    }

    public static function getSkillsInPresetByType($presetId, $type) {
        require_once(__DIR__ . "/connection.php");
        $database = createPDO();

        $SQL = "SELECT skill.* FROM skill 
        JOIN skill_preset ON skill.id = skill_preset.id_skill 
        WHERE skill_preset.id_preset = :id_preset AND skill.type = :type";
        $request = $database->prepare($SQL);
        $request->bindParam(':id_preset', $presetId);
        $request->bindParam(':type', $type);
        $success = $request->execute();
        
        if (!$success) {
            return null;
        }
        
        $result = $request->fetchAll(PDO::FETCH_ASSOC);
        
        $skillFiltered = array();
        foreach ($result as $skill) {
            $skillFiltered[] = new Skill($skill);
        }

        return $skillFiltered;
    }
}