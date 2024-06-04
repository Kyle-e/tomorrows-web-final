<?php

declare(strict_types= 1);

function create_post(object $conn, int $userId, string $post) {
    set_post($conn, $userId, $post);
}
