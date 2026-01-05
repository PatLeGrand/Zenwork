<?php
    function validateEmail($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    function validatePassword($password){
        return strlen($password) >= 8;
    }

    function validateName($name){
        $name = trim($name);
        return strlen($name) >= 2;

    }

    function sanitizeInput($data){
        $data = trim($data);
        $data = htmlspecialchars($data);
        return $data;
    }

?>
