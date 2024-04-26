<?php

class Skill {

    public ?int $id;
    public ?string $name;
    public ?string $characteristic;
    public ?string $type;
    public ?int $rank;
    public ?int $career;

    private static $format = array(
        'id' => FILTER_VALIDATE_INT,
        'name' => FILTER_SANITIZE_SPECIAL_CHARS,
        'characteristic' => FILTER_SANITIZE_SPECIAL_CHARS,
        'type' => FILTER_SANITIZE_SPECIAL_CHARS,
        'rank' => FILTER_VALIDATE_INT,
        'career' => FILTER_VALIDATE_INT,
    );

    public function __construct(array $array) {
        $this->id = $array['id'];
        $this->name = $array['name'];
        $this->characteristic = $array['characteristic'];
        $this->type = $array['type'];
        $this->career = $array['career'];
        $this->rank = $array['rank'];
    }
}