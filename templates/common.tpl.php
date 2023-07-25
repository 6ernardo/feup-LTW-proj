<?php declare(strict_types = 1); ?>

<?php function drawHeader(Session $session) { ?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Ticket Site</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/style.css"> 
        <script src="../javascript/ticketfilter.js" defer></script>
    </head>
    <body>
        <?php drawMessages($session); ?>
        <header>
            <nav>
                <h1><a href="../pages/">Ticket Site</a></h1>
                <div id="nav_buttons">
                    <p><a href="../pages/faq.php">FAQ</a></p>
                    <?php
                        if($session->isLoggedIn()) drawLoggedIn();
                        else drawLoggedOff();
                    ?>
<?php } ?>

<?php function drawLoggedIn() { ?>
            <p><a href="../pages/editprofile.php">Edit Profile</a></p>
            <p><a href="../actions/action_logout.php">Logout</a></p>
        </div>
    </nav>
</header>
<main>
<?php } ?>

<?php function drawLoggedOff() { ?>
            <p><a href="../pages/login.php">Login</a><p>
            <p><a href="../pages/register.php">Register</a><p>
        </div>
    </nav>
</header>
<main>
    <p>Welcome to our Support Ticket Website. Login or register a new account to get started!</p>
<?php } ?>


<?php function drawFooter() { ?>
        </main>
        <footer>
            LTW Ticket Site 2023
        </footer>
    </body>
</html>
<?php } ?>

<?php function drawMessages(Session $session) { ?>
    <section id="messages">
        <?php foreach($session->getMessages() as $message) { ?>
            <article class="<?=$message['type']?>">
                <?=$message['text']?>
            </article>
        <?php } ?>
    </section>
<?php } ?>

<?php function drawButton(string $text, string $path) { ?>
<button class="special"><a href="<?=$path?>"><?=$text?></a></button>
<?php } ?>
