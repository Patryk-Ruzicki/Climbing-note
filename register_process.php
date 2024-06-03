<?php
include 'db.php';

$login = $_POST['login'];
$password = sha1($_POST['password']);

$query = "INSERT INTO uzytkownicy (login, haslo) VALUES ('$login', '$password')";
if (mysqli_query($conn, $query)) {
    header('Location: login.php');
} else {
    echo "Błąd rejestracji: " . mysqli_error($conn);
}
?>