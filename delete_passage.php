<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$passage_id = intval($_GET['id']);

$query1 = "DELETE FROM przejscia_uzytkownicy WHERE id_przejscia = $passage_id";
$query2 = "DELETE FROM przejscia WHERE id = $passage_id";

if (mysqli_query($conn, $query1) && mysqli_query($conn, $query2)) {
    header('Location: user_panel.php');
} else {
    echo "Błąd usuwania przejścia: " . mysqli_error($conn);
}
?>