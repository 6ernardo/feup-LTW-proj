<?php declare(strict_types = 1); ?>

<?php function drawLoginForm() { ?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Login - Ticket Site</title>
        <meta charset="utf-8">
    </head>
    <body>
        <header>Login</header>
        <main>
            <form>
                <input type="text" placeholder="Username" name="username" required>
                <input type="password" placeholder="Password" name="password" required>
                <button type="submit" name="login">Login</button>
            </form>
            <p><a href="register.php">Still do not have an account? Click here!</a></p>
            <button><a href="..">Back to Main Page</a></button>
        </main>    
    </body>
</html>
<?php } ?>

<?php function drawRegisterForm() { ?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Register - Ticket Site</title>
        <meta charset="utf-8">
    </head>
    <body>
        <header>Register</header>
        <main>
            <form action="../actions/action_register.php" method="POST">
                <input type="text" placeholder="Username" name="username" required>
                <input type="email" placeholder="Email" name="email" required>
                <input type="password" placeholder="Password" name="password" required>
                <input type="password" placeholder="Confirm Password" name="password_confirm" required>
                <button type="submit" name="register">Register</button>
            </form>
            <p><a href="login.php">Already have an account? Click here!</a></p>
            <button><a href="..">Back to Main Page</a></button>
        </main>    
    </body>
</html>
<?php } ?>