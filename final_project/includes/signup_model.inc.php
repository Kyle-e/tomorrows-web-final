<?php

declare(strict_types= 1);

function get_username(object $conn, string $username) {
    $query = "SELECT username FROM users WHERE username = :username;";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function get_email(object $conn, string $email) {
    $query = "SELECT username FROM users WHERE email = :email;";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function set_user(object $conn, string $pswd, string $username, string $email) {
    $query = "INSERT INTO users (username, pswd, email) VALUES (:username, :pswd, :email);";

    $options = [
        'cost' => 12
    ];
    $hashedPswd = password_hash($pswd, PASSWORD_BCRYPT, $options);

    $stmt = $conn->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":pswd", $hashedPswd);
    $stmt->bindParam(":email", $email);
    $stmt->execute();
}
