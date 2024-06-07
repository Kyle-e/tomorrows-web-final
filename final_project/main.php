<?php
require_once 'includes/dbc.inc.php';
require_once 'includes/config_session.inc.php';
require_once 'includes/login_view.inc.php';
require_once 'includes/posts_model.inc.php';

$posts = display_posts($conn);

$apiLink = 'https://api.quotable.io/random';
$quote = json_decode(file_get_contents($apiLink));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="stylesheets/main.css">
    <title>Home</title>
</head>
<body>

    <!-- DISPLAY IF USER IS LOGGED IN OR NOT -->
    <div id="login-box">
        <h4 id="login-state">
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
    </div>

    <div id="create-post">
        <?php

        // CREATE POST
        if (isset($_SESSION["user_id"])) { ?>
            <form action="includes/posts.inc.php" method="post">
                <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                <textarea name="post" placeholder="Write a post"></textarea>
                <br>
                <button>Post</button>
            </form>
        <?php } ?>
    </div>     
    
    <div id="posts">


        <?php

        ?>

        <?php foreach ($posts as $post): ?>
        <div>
            <h3 id="post"><?php echo htmlspecialchars($post["post"]); ?></h3>
            <p>Posted by <?php echo htmlspecialchars($post["user_id"]); ?> at <?php echo htmlspecialchars($post['timestamp']); ?></p>
            <br>
        </div>
        <?php endforeach; ?>
    </div>

    <footer>
        <div>
            <h4><?php echo $quote->content;?></h4>
            <h5><?php echo $quote->author;?></h5>
            <div>
                <?php foreach($quote->tags as $tag) { ?>
                    <span>
                        # <?php echo $tag;?>
                    </span>
                <?php } ?>
            </div>
        </div>
    </footer>


</body>
</html>
