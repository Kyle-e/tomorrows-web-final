<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $pswd = $_POST["pswd"];

    try {
        require_once 'dbc.inc.php';
        require_once 'login_model.inc.php';
        require_once 'login_cont.inc.php';

        // ERROR HANDLING
        $errors = [];

        if (if_username_special($username)) {
            $errors["specialchar_user"] = "Username: can't use special characters";
        }
        if (if_input_empty($username, $pswd)) {
            $errors["empty_input"] = "Fields missing input";
        }

        $result = get_user($conn, $username);

        if (if_user_incorrect($result)) {
            $errors["login_incorrect"] = "Incorrect login";
        }

        if (!if_user_incorrect($result) && if_password_incorrect($pswd, $result["pswd"])) {
            $errors["login_incorrect"] = "Incorrect login";
        }

        require_once 'config_session.inc.php';

        if ($errors) {
            $_SESSION["errors_login"] = $errors;

            header("Location: ../index.php");
            die();
        }

        // CREATE SESSION WITH USER ID
        $newsessionID = session_create_id();
        $sessionID = $newsessionID . "_" . $result["id"];
        session_id($sessionID);

        $_SESSION["user_id"] = $result["id"];
        $_SESSION["user_username"] = htmlspecialchars($result["username"]);

        $_SESSION["last_regeneration"] = time(); 

        // REDIRECT TO PAGE ON LOGIN
        header("Location: ../main.php?login=success");
        $conn = null;
        $stmt = null;

        die();
    } catch (PDOException $e) {
        die("Query failed: ". $e->getMessage());
    }
}
else {
    header("Location: ../index.php");
    die();
}
