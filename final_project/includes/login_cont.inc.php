<?php

declare(strict_types= 1);

function if_input_empty(string $username, string $pswd) {
    if (empty($username) || empty($pswd)) {
        return true;
    } else {
        return false;
    }
}

function if_user_incorrect(bool|array $result) {
    if (!$result) {
        return true;
    } else {
        return false;
    }
}

function if_password_incorrect(string $pswd, string $hashedPswd) {
    if (!password_verify($pswd, $hashedPswd)) {
        return true;
    } else {
        return false;
    }
}
