<?php
class Preset implements JsonSerializable{
    public ?int $id;
    public ?string $name;

    private static $format = array(
        'id' => FILTER_VALIDATE_INT,
        'name' => FILTER_SANITIZE_SPECIAL_CHARS,
    );
    
    public function __construct(array $array) {
        $this->id = $array['id'];
        $this->name = $array['name'];
    }

    public function jsonSerialize() {
        $vars = get_object_vars($this);
        return json_encode($vars);
    }
}