<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $pswd = $_POST["pswd"];
    $email = $_POST["email"];
    
    try {
        require_once 'dbc.inc.php';
        require_once 'signup_model.inc.php';
        require_once 'signup_cont.inc.php';

        // ERROR HANDLING
        $errors = [];

        if (if_username_special($username)) {
            $errors["specialchar_user"] = "Username: can't use special characters";
        }      
        if (is_input_empty($username, $pswd, $email)) {
            $errors["empty_input"] = "Fields missing input";
        }
        if (is_email_invalid($email)) {
            $errors["invalid_email"] = "Invalid email";
        }
        if (is_user_taken($conn, $username)) {
            $errors["user_taken"] = "Username already taken";
        }
        if (is_email_registered($conn, $email)) {
            $errors["email_used"] = "Email already registered";
        }

        require_once 'config_session.inc.php';

        if ($errors) {
            $_SESSION["errors_signup"] = $errors;

            $signup_data = [
                "username" => $username,
                "email" => $email
            ];
            $_SESSION["signup_data"] = $signup_data;

            header("Location: ../index.php");
            die();
        }

        create_user($conn, $pswd, $username, $email);

        header("Location: ../index.php?signup=success");

        $conn = null;
        $stmt = null;

        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
    die();
}
