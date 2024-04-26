<?php
class CharacterSkill { 
    public ?int $idSkill;
    public ?int $rank;
    public ?string $characteristic;

    private static $format = array(
        'id_skill' => FILTER_VALIDATE_INT,
        'rank' => FILTER_VALIDATE_INT,
        'characteristic' => FILTER_SANITIZE_STRING,
    );

    public function __construct(array $array) {
        $filtered = filter_var_array($array, self::$format);
        $this->idSkill = $filtered['id_skill'];
        $this->rank = $filtered['rank'];
        $this->characteristic = $filtered['characteristic'];
    }
}