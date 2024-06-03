<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>Rejestracja</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h2>Rejestracja</h2>
    <form action="register_process.php" method="post">
        <label for="login">Login:</label>
        <input type="text" id="login" name="login" required><br>
        <label for="password">Hasło:</label>
        <input type="password" id="password" name="password" required><br>
        <button type="submit">Zarejestruj</button>
    </form>
    <p>Masz już konto? <a href="login.php">Zaloguj się</a></p>
</body>

</html>