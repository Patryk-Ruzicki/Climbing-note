<?php
session_start();
include 'db.php';

$login = $_POST['login'];
$password = sha1($_POST['password']);

$query = "SELECT id FROM uzytkownicy WHERE login = '$login' AND haslo = '$password'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 1) {
    $_SESSION['user_id'] = mysqli_fetch_assoc($result)['id'];
    header('Location: user_panel.php');
} else {
    echo "Błędny login lub hasło";
}
?>