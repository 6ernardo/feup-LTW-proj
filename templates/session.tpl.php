<?php declare(strict_types = 1); ?>

<?php function drawLoginForm() { ?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Login - Ticket Site</title>
        <link rel="stylesheet" href="../css/session.css"> 
        <meta charset="utf-8">
    </head>
    <body>
        <header><h1>Login</h1>  </header>
        <main>
            <form action="../actions/action_login.php" method="POST">
                <input type="text" placeholder="Username" name="username" required>
                <input type="password" placeholder="Password" name="password" required>
                <button type="submit" name="login">Login</button>
            </form>
            <p>Still do not have an account? <a href="register.php">Click here!</a></p>
            <button class="special"><a href="..">Back to Main Page</a></button>
        </main>    
    </body>
</html>
<?php } ?>

<?php function drawRegisterForm() { ?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Register - Ticket Site</title>
        <link rel="stylesheet" href="../css/session.css"> 
        <meta charset="utf-8">
    </head>
    <body>
        <header><h1>Register</h1></header>
        <main>
            <form action="../actions/action_register.php" method="POST">
                <input type="text" placeholder="Username" name="username" required>
                <input type="email" placeholder="Email" name="email" required>
                <input type="password" placeholder="Password" name="password" required>
                <input type="password" placeholder="Confirm Password" name="password_confirm" required>
                <button type="submit" name="register">Register</button>
            </form>
            <p>Already have an account? <a href="login.php">Click here!</a></p>
            <button class="special"><a href="..">Back to Main Page</a></button>
        </main>    
    </body>
</html>
<?php } ?>