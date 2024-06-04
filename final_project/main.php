<?php
require_once 'includes/dbc.inc.php';
require_once 'includes/config_session.inc.php';
require_once 'includes/login_view.inc.php';
require_once 'includes/posts_view.inc.php';
require_once 'includes/posts_model.inc.php';

$posts = display_posts($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="stylesheets/main.css">
</head>
<body>

    <h4>
        <?php
        show_username();
        ?>
    </h4>

    <?php
        if (isset($_SESSION["user_id"])) { ?>
            <form action="includes/logout.inc.php" method="post">
                <br>
                <button>Logout</button>
            </form>      
    <?php } ?>

    <?php

    // CREATE POST
    if (isset($_SESSION["user_id"])) { ?>
        <form action="includes/posts.inc.php" method="post">
        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
        <input name="post" placeholder="Write a post"></input>
        <button>Post</button>
        </form>
    <?php } ?>

    <?php

    ?>

    <?php foreach ($posts as $post): ?>
    <div class="post">
        <h2><?php echo htmlspecialchars($post["post"]); ?></h2>
        <p>Posted by <?php echo htmlspecialchars($post["user_id"]); ?> at <?php echo htmlspecialchars($post['timestamp']); ?></p>
    </div>
    <?php endforeach; ?>

</body>
</html>
