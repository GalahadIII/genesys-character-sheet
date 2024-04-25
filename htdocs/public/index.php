<?php
include_once(__DIR__ . "/../data/PresetDAO.php");

$presets = PresetDAO::listPreset();
var_dump($presets);
?>

<!DOCTYPE html>
<html>
<head>
<title>Genesys Character Sheet</title>
</head>

<body>
Connection

<form action="listCharacter.php" method="get">
    <input type="text" name="playerName" placeholder="Player Name">
    <button type="submit">Find</button>
</form>

</body>

</html> 