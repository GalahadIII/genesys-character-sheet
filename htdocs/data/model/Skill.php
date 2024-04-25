<?php

class Skill implements JsonSerializable {

    public ?int $id;
    public ?string $name;
    public ?string $characteristic;
    public ?string $type;

    private static $format = array(
        'id' => FILTER_VALIDATE_INT,
        'name' => FILTER_SANITIZE_SPECIAL_CHARS,
        'characteristic' => FILTER_SANITIZE_SPECIAL_CHARS,
        'type' => FILTER_SANITIZE_SPECIAL_CHARS,
    );

    public function __construct(array $array) {
        $this->id = $array['id'];
        $this->name = $array['name'];
        $this->characteristic = $array['characteristic'];
        $this->type = $array['type'];
    }

    public function jsonSerialize() {
        $vars = get_object_vars($this);
        return json_encode($vars);
    }
}