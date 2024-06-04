<?php
include 'db.php';

$login = mysqli_real_escape_string($conn, $_POST['login']);
$password = sha1($_POST['password']);

if (strlen($login) > 50) {
    echo "Login nie może mieć więcej niż 50 znaków.";
    exit();
}

$query = "SELECT * FROM uzytkownicy WHERE login = '$login'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    echo "Użytkownik o tym loginie już istnieje.";
    exit();
}

$query = "INSERT INTO uzytkownicy (login, haslo) VALUES ('$login', '$password')";
if (mysqli_query($conn, $query)) {
    header('Location: login.php');
} else {
    echo "Błąd rejestracji: " . mysqli_error($conn);
}
?>