<?php

declare(strict_types= 1);

function if_username_special(string $username) {
    if (preg_match('/[^a-zA-Z0-9]/', $username)) {
        return true;
    }
    else {
        return false;
    }
}

function is_input_empty(string $username, string $pswd, string $email) {
    if(empty($username) || empty($pswd) || empty($email)) {
        return true;
    }
    else {
        return false;
    }
}

function is_email_invalid(string $email) {
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    else {
        return false;
    }
}

function is_user_taken(object $conn, string $username) {
    if (get_username($conn, $username)) {
        return true;
    }
    else {
        return false;
    }
}

function is_email_registered(object $conn, string $email) {
    if (get_email($conn, $email)) {
        return true;
    }
    else {
        return false;
    }
}

function create_user(object $conn, string $pswd, string $username, string $email) {
    set_user($conn, $pswd, $username, $email);
}
