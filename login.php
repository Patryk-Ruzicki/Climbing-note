<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>Logowanie</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h2>Logowanie</h2>
    <form action="login_process.php" method="post">
        <label for="login">Login:</label>
        <input type="text" id="login" name="login" required><br>
        <label for="password">Hasło:</label>
        <input type="password" id="password" name="password" required><br>
        <button type="submit">Zaloguj</button>
    </form>
    <p>Nie masz konta? <a href="register.php">Zarejestruj się</a></p>
</body>

</html>