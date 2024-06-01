<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/signup_view.inc.php';
require_once 'includes/login_view.inc.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <h2>Log in</h2>

    <form action="includes/login.inc.php" method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="pswd" placeholder="Password">
        <button>Log in</button>
    </form>
    
    <?php
    check_login_errors();
    ?>

    <h2>Sign up</h2>
    <form action="includes/signup.inc.php" method="post">
        <?php
        signup_inputs();
        ?>
        <button>Sign up</button>
    </form>

    <?php
    check_signup_errors(); 
    ?>

</body>

</html>
