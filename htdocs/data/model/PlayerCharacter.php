<?php

class PlayerCharacter implements JsonSerializable {
    
    public ?int $id;
    public ?string $name;
    public ?string $archertype;
    public ?string $career;
    public ?int $strain;
    public ?int $strainTreshold;
    public ?int $wound;
    public ?int $woundTreshold;
    public ?int $defenseMelee;
    public ?int $defenseRanged;
    public ?int $soak;
    public ?string $playerName;
    public ?int $xpTotal;
    public ?int $xpAvailable;
    public ?int $skillPreset;

    private static $format = array(
        'id' => FILTER_VALIDATE_INT,
        'name' => FILTER_SANITIZE_SPECIAL_CHARS,
        'archetype' => FILTER_SANITIZE_SPECIAL_CHARS,
        'career' => FILTER_SANITIZE_SPECIAL_CHARS,
        'strain' => FILTER_VALIDATE_INT,
        'strain_threshold' => FILTER_VALIDATE_INT,
        'wound' => FILTER_VALIDATE_INT,
        'wound_threshold' => FILTER_VALIDATE_INT,
        'defense_melee' => FILTER_VALIDATE_INT,
        'defense_ranged' => FILTER_VALIDATE_INT,
        'soak' => FILTER_VALIDATE_INT,
        'player_name' => FILTER_SANITIZE_SPECIAL_CHARS,
        'xp_total' => FILTER_VALIDATE_INT,
        'xp_available' => FILTER_VALIDATE_INT,
        'skill_preset' => FILTER_VALIDATE_INT,
    );

    public function __construct(array $array) {
        $filtered = filter_var_array($array, self::$format);
        $this->id = $filtered['id'];
        $this->name = $filtered['name'];
        $this->archetype = $filtered['archetype'];
        $this->career = $filtered['career'];
        $this->strain = $filtered['strain'];
        $this->strainThreshold = $filtered['strain_threshold'];
        $this->wound = $filtered['wound'];
        $this->woundThreshold = $filtered['wound_threshold'];
        $this->defenseMelee = $filtered['defense_melee'];
        $this->defenseRanged = $filtered['defense_ranged'];
        $this->soak = $filtered['soak'];
        $this->playerName = $filtered['player_name'];
        $this->xpTotal = $filtered['xp_total'];
        $this->xpAvailable = $filtered['xp_available'];
        $this->skillPreset = $filtered['skill_preset'];
    }

    public function jsonSerialize() {
        $vars = get_object_vars($this);
        return json_encode($vars);
    }
}
