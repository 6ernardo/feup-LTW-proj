<?php declare(strict_types = 1); ?>

<?php function drawEditProfile(Session $session) { ?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Edit Profile - Ticket Site</title>
        <meta charset="utf-8">
    </head>
    <body>
        <header><h1>Edit Profile</h1></header>
        <main>
            <form action="../actions/action_edit_profile.php" method="POST">
                <input type="text" placeholder="<?=$session->getUsername()?>" name="username">
                <input type="email" placeholder="<?=$session->getEmail()?>" name="email">
                <input type="password" placeholder="Password" name="password">
                <input type="password" placeholder="Confirm Password" name="password_confirm">
                <button type="submit" name="submit">Submit changes</button>
            </form>
        </main>
    </body>
<?php } ?>