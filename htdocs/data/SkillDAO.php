<?php
require_once(__DIR__ . "/model/Skill.php");

Class SkillDAO {
    public static function listSkills() {
        $database = require_once(__DIR__ . "/connection.php");
        $database = createPDO();

        $SQL = "SELECT * FROM skill WHERE 1";
        
        $request = $database->prepare($SQL);
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
    
    public static function addSkillToPreset($skillId, $presetId) {
        require_once(__DIR__ . "/connection.php");
        $database = createPDO();
        
        $SQL = "INSERT INTO skill_preset (id_skill, id_preset) VALUES (:id_skill, :id_preset)";
        $request = $database->prepare($SQL);
        $request->bindParam(':id_skill', $skillId);
        $request->bindParam(':id_preset', $presetId);
        $success = $request->execute();

        if (!$success) {
            return null;
        }
        return true;
    }
}