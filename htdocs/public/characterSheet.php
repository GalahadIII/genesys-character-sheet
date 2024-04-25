<?php
require_once(__DIR__ . "/../data/CharacterDAO.php");
require_once(__DIR__ . "/../data/CharacteristicDAO.php");
require_once(__DIR__ . "/../data/PresetDAO.php");

$playerName = filter_var($_GET['playerName']);
$characterName = filter_var($_GET['characterName']);
$character = CharacterDAO::getCharacterFromPlayer($playerName, $characterName);
$characteristic = CharacteristicDAO::getCharacteristicByCharacter($character->id);
$skillPreset = $character->skillPreset;
?>
<h2><?= $character->name ?></h2>
<?php
$types = PresetDAO::getSkillTypesInPreset($skillPreset);

var_dump($characteristic);

foreach ($types as $type) {
    $skills = PresetDAO::getSkillsInPresetByType($skillPreset, $type);
    echo "<br> Type: " . $type . "<br>";
    foreach ($skills as $skill) {
        echo "- " . $skill->name . "\n";
    }
    echo "\n";
}