<?php
include 'db.php';
session_start();

$login = mysqli_real_escape_string($conn, $_POST['login']);
$password = sha1($_POST['password']);

if (strlen($login) > 50) {
    $_SESSION['error'] = "Login nie może mieć więcej niż 50 znaków.";
    header('Location: register.php');
    exit();
}

$query = "SELECT * FROM uzytkownicy WHERE login = '$login'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $_SESSION['error'] = "Użytkownik o tym loginie już istnieje.";
    header('Location: register.php');
    exit();
}

$query = "INSERT INTO uzytkownicy (login, haslo) VALUES ('$login', '$password')";
if (mysqli_query($conn, $query)) {
    $_SESSION['alert'] = "Konto zostało utworzone";
    header('Location: login.php');
    exit();
} else {
    $_SESSION['error'] = "Błąd rejestracji: " . mysqli_error($conn);
    header('Location: register.php');
    exit();
}
?>