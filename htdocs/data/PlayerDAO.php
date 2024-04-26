<?php
class PlayerDAO { 


    public static function createUser($username, $name, $password){
        require_once(__DIR__ . "/connection.php");
        $database = createPDO();

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $SQL = "INSERT INTO player (username, name, password) VALUES (:username, :name, :password)";

        $request = $database->prepare($SQL);
        $request->bindValue(':username', $username, PDO::PARAM_STR);
        $request->bindValue(':name', $name, PDO::PARAM_STR);
        $request->bindValue(':password', $hashedPassword, PDO::PARAM_STR);
        $success = $request->execute();

        return $success;
    }

    public static function validatePassword($username, $password){
        require_once(__DIR__ . "/connection.php");
        $database = createPDO();

        $SQL = "SELECT password FROM player WHERE username = :username";

        $request = $database->prepare($SQL);
        $request->bindValue(':username', $username, PDO::PARAM_STR);
        $success = $request->execute();

        if (!$success) {
            return false;
        }

        $result = $request->fetch(PDO::FETCH_ASSOC);
        $hashedPassword = $result['password'];

        // Verify the password
        return password_verify($password, $hashedPassword);
    }
}
