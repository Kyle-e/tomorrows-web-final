<?php
/* FILE: LOG IN ERROR FUNCTIONS */

declare(strict_types=1);

function show_username() {
    if (isset($_SESSION["user_id"])) {
        echo "Logged in as " . $_SESSION["user_username"];        
    } else {
        echo "Currently signed out";
    }

}

function check_login_errors() {
    if (isset($_SESSION["errors_login"])) {
        $errors = $_SESSION["errors_login"];

        echo "<br>";

        foreach ($errors as $error) {
            echo '<p class="form-error">' . $error . '</p>';
        }

        unset($_SESSION['errors_login']);
    } else if (isset($_GET['login']) && $_GET['login'] === "success") {
        echo '<br>';
        echo '<p class="form-success">Login success!</p>';
    }
}
