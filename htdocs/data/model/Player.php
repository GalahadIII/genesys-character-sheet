<?php
class Player { 
    public ?int $id;
    public ?string $username;
    public ?string $name;
    public ?string $password;

    private static $format = array(
        'id' => FILTER_VALIDATE_INT,
        'username' => FILTER_SANITIZE_STRING,
        'name' => FILTER_SANITIZE_STRING,
        'password' => FILTER_SANITIZE_STRING,
    );

    public function __construct(array $array) {
        $filtered = filter_var_array($array, self::$format);
        $this->id = $filtered['id'];
        $this->username = $filtered['username'];
        $this->name = $filtered['name'];
        $this->password = $filtered['password'];
    }
}