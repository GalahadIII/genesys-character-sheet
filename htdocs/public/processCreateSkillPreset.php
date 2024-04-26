<?php
include_once(__DIR__ . "/../data/SkillDAO.php");
include_once(__DIR__ . "/../data/PresetDAO.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["selectedSkills"]) && !empty($_POST["selectedSkills"])) {
        // Retrieve selected skill IDs from the form submission
        var_dump($_POST);
        $selectedSkillIds = $_POST["selectedSkills"];

        $presetId = PresetDAO::createPreset($_POST["presetName"]);

        // Insert selected skills into the skill_preset table
        foreach ($selectedSkillIds as $skillId) {
            SkillDAO::addSkillToPreset($skillId, $presetId);
        }

        echo "success";
    } else {
        echo "no skills selected";
    }
} else {
    // If the form was not submitted via POST method, redirect back to the form page
    exit;
}
