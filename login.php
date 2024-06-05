<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Logowanie</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Logowanie</h2>
    <p class='alert'>
            <?php
                if (isset($_SESSION['alert'])) {
                    echo $_SESSION['alert'];
                    unset($_SESSION['alert']);
                }
            ?>
    </p>
    <form action="login_process.php" method="post">
        <label for="login">Login:</label>
        <input type="text" id="login" name="login" max="50" required><br>
        <label for="password">Hasło:</label>
        <input type="password" id="password" name="password" max="40" required><br>
        <p class='error'>
            <?php
                if (isset($_SESSION['error'])) {
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                }
            ?>
        </p>
        <br>
        <button type="submit">Zaloguj</button>
    </form>
    <p>Nie masz konta? <a href="register.php">Zarejestruj się</a></p>
</body>
</html>