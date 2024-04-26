<?php
class Character { 
    public ?int $id;
    public ?int $idPlayer;
    public ?string $name;
    public ?string $archetype;
    public ?string $career;
    public ?int $skillPreset;
    public ?int $strain;
    public ?int $strainThreshold;
    public ?int $wound;
    public ?int $woundThreshold;
    public ?int $defenseMelee;
    public ?int $defenseRanged;
    public ?int $soak;
    public ?int $xpTotal;
    public ?int $xpAvailable;
    public ?int $dicePool;

    private static $format = array(
        'id' => FILTER_VALIDATE_INT,
        'id_player' => FILTER_VALIDATE_INT,
        'name' => FILTER_SANITIZE_STRING,
        'archetype' => FILTER_SANITIZE_STRING,
        'career' => FILTER_SANITIZE_STRING,
        'skill_preset' => FILTER_VALIDATE_INT,
        'strain' => FILTER_VALIDATE_INT,
        'strain_threshold' => FILTER_VALIDATE_INT,
        'wound' => FILTER_VALIDATE_INT,
        'wound_threshold' => FILTER_VALIDATE_INT,
        'defense_melee' => FILTER_VALIDATE_INT,
        'defense_ranged' => FILTER_VALIDATE_INT,
        'soak' => FILTER_VALIDATE_INT,
        'xp_total' => FILTER_VALIDATE_INT,
        'xp_available' => FILTER_VALIDATE_INT,
        'dice_pool' => FILTER_VALIDATE_INT,
    );

    public function __construct(array $array) {
        $filtered = filter_var_array($array, self::$format);
        $this->id = $filtered['id'];
        $this->idPlayer = $filtered['id_player'];
        $this->name = $filtered['name'];
        $this->archetype = $filtered['archetype'];
        $this->career = $filtered['career'];
        $this->skillPreset = $filtered['skill_preset'];
        $this->strain = $filtered['strain'];
        $this->strainThreshold = $filtered['strain_threshold'];
        $this->wound = $filtered['wound'];
        $this->woundThreshold = $filtered['wound_threshold'];
        $this->defenseMelee = $filtered['defense_melee'];
        $this->defenseRanged = $filtered['defense_ranged'];
        $this->soak = $filtered['soak'];
        $this->xpTotal = $filtered['xp_total'];
        $this->xpAvailable = $filtered['xp_available'];
        $this->dicePool = $filtered['dice_pool'];
    }
}

