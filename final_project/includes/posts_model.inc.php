<?php

declare(strict_types= 1);

function set_post(object $conn, int $userId, string $post) {
    $query = "INSERT INTO posts (user_id, post) VALUES (:user_id, :post);";
    $stmt = $conn->prepare($query);

    $stmt->bindParam(":user_id", $userId);
    $stmt->bindParam(":post", $post);
    $stmt->execute();
}

function display_posts(object $conn) {
    $query = "SELECT * FROM posts user_id ORDER BY timestamp DESC;";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
