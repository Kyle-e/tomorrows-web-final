<?php
require_once 'dbc.inc.php';

/* if(!isset($_SESSION["user_id"])) {

    header("Location: ../index.php");
    die();
} */

// EXECUTE IF 'POST' BUTTON IS PRESSED
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userId = $_POST["user_id"];
    $post = $_POST["post"];

    require_once 'config_session.inc.php';


    try {
        require_once 'dbc.inc.php';
        require_once 'posts_model.inc.php';
        require_once 'posts_cont.inc.php';

        create_post($conn, $userId, $post);

        header("Location: ../main.php?post=created");

        $conn = null;
        $stmt = null;        

        die();

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Request error";
}
