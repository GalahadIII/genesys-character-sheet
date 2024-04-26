<?php
require_once(__DIR__ . "/../../data/CharacterDAO.php");

$playerName = filter_var($_GET["playerId"]);
$playerName = filter_var($_GET["name"]);

$listCharacter = CharacterDAO::getCharacterByPlayerId($playerId);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

print_r(json_encode($listCharacter));