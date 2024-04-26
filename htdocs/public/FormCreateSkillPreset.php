<?php
include_once(__DIR__ . "/../data/SkillDAO.php");
include_once(__DIR__ . "/../data/PresetDAO.php");

$skills = SkillDAO::listSkills();
?>

<form action="processCreateSkillPreset.php" method="post">
<input type="text" name="presetName" placeholder="Preset Name">

<?php
foreach ($skills as $skill) { 
?>
    <div>
        <label><?php echo $skill->name; ?></label>
        <span><?php echo $skill->type; ?></span>
        <input type="checkbox" name="selectedSkills[]" value="<?php echo $skill->id; ?>">
    </div>
<?php
}
?>
    <button type="submit">Create Preset</button>
</form>
