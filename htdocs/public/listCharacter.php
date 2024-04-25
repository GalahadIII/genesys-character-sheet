<?php
require_once(__DIR__ . "/../data/CharacterDAO.php");

$playerName = filter_var($_GET['playerName']);

$listCharacter = CharacterDAO::getCharactersByPlayerName($playerName);

?>
<form action="characterSheet.php" method="get">
<?php
foreach($listCharacter as $character) {
?>
    <a href="characterSheet.php?playerName=<?= $playerName ?>&characterName=<?= $character->name ?>">
        <div>
            <h3><?= $character->name ?></h3>
        </div>
    </a>
<?php
}
?>
</form>
