<?php
class Characteristic { 
    
    public ?int $brawn;
    public ?int $agility;
    public ?int $intellect;
    public ?int $cunning;
    public ?int $willpower;
    public ?int $presence;

    private static $format = array(
        'brawn' => FILTER_VALIDATE_INT,
        'agility' => FILTER_VALIDATE_INT,
        'intellect' => FILTER_VALIDATE_INT,
        'cunning' => FILTER_VALIDATE_INT,
        'willpower' => FILTER_VALIDATE_INT,
        'presence' => FILTER_VALIDATE_INT,
    );

    public function __construct(array $array) {
        $filtered = filter_var_array($array, self::$format);
        $this->brawn = $filtered['brawn'];
        $this->agility = $filtered['agility'];
        $this->intellect = $filtered['intellect'];
        $this->cunning = $filtered['cunning'];
        $this->willpower = $filtered['willpower'];
        $this->presence = $filtered['presence'];
    }
}
