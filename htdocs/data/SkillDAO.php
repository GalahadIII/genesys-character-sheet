<?php
require_once(__DIR__ . "/model/Skill.php");

Class SkillDAO {

    public static function listSkills(){
        require_once(__DIR__ . "/connection.php");
        $database = createPDO();

        $SQL = "SELECT * FROM skill";

        $request = $database->prepare($SQL);
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
}