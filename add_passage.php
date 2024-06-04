<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$nazwa_drogi = mysqli_real_escape_string($conn, $_POST['nazwa_drogi']);
$data_przejscia = mysqli_real_escape_string($conn, $_POST['data_przejscia']);
$styl_przejscia = mysqli_real_escape_string($conn, $_POST['styl_przejscia']);
$wycena_drogi = mysqli_real_escape_string($conn, $_POST['wycena_drogi']);

if (strlen($nazwa_drogi) > 100) {
    echo "Nazwa drogi nie może mieć więcej niż 100 znaków.";
    exit();
}

if (strlen($styl_przejscia) > 50) {
    echo "Styl przejścia nie może mieć więcej niż 50 znaków.";
    exit();
}

if (strlen($wycena_drogi) > 10) {
    echo "Wycena drogi nie może mieć więcej niż 10 znaków.";
    exit();
}

if (new DateTime($data_przejscia) > new DateTime()) {
    echo "Data przejścia nie może być z przyszłości.";
    exit();
}

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