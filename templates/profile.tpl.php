<?php declare(strict_types = 1); ?>

<?php function drawEditProfile(Session $session) { ?>
    <div id="profile_edit">
        <h2>Edit Profile</h2>
        <form action="../actions/action_edit_profile.php" method="POST">
            <input type="text" placeholder="<?=$session->getUsername()?>" name="username">
            <input type="email" placeholder="<?=$session->getEmail()?>" name="email">
            <input type="password" placeholder="Password" name="password">
            <input type="password" placeholder="Confirm Password" name="password_confirm">
            <button type="submit" name="submit">Submit changes</button>
        </form>
    </div>
<?php } ?>