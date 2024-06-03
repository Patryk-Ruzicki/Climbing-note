<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$nazwa_drogi = $_POST['nazwa_drogi'];
$data_przejscia = $_POST['data_przejscia'];
$styl_przejscia = $_POST['styl_przejscia'];
$wycena_drogi = $_POST['wycena_drogi'];

$query1 = "INSERT INTO przejscia (data_przejscia, nazwa_drogi, wycena_drogi, styl_przejscia) VALUES ('$data_przejscia', '$nazwa_drogi', '$wycena_drogi', '$styl_przejscia')";
if (mysqli_query($conn, $query1)) {
    $passage_id = mysqli_insert_id($conn);
    $query2 = "INSERT INTO przejscia_uzytkownicy (id_uzytkownika, id_przejscia) VALUES ('$user_id', '$passage_id')";
    if (mysqli_query($conn, $query2)) {
        header('Location: user_panel.php');
    } else {
        echo "Błąd dodawania przejścia użytkownika: " . mysqli_error($conn);
    }
} else {
    echo "Błąd dodawania przejścia: " . mysqli_error($conn);
}
?>