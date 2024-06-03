<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$passage_id = $_GET['id'];
$query = "SELECT * FROM przejscia WHERE id = $passage_id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nazwa_drogi = $_POST['nazwa_drogi'];
    $data_przejscia = $_POST['data_przejscia'];
    $styl_przejscia = $_POST['styl_przejscia'];
    $wycena_drogi = $_POST['wycena_drogi'];

    $query = "UPDATE przejscia SET data_przejscia = '$data_przejscia', nazwa_drogi = '$nazwa_drogi', wycena_drogi = '$wycena_drogi', styl_przejscia = '$styl_przejscia' WHERE id = $passage_id";
    if (mysqli_query($conn, $query)) {
        header('Location: user_panel.php');
    } else {
        echo "Błąd edycji przejścia: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>Edytuj przejście</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h2>Edytuj przejście</h2>
    <form method="post">
        <label for="nazwa_drogi">Nazwa drogi:</label>
        <input type="text" id="nazwa_drogi" name="nazwa_drogi" value="<?= $row['nazwa_drogi'] ?>" required><br>
        <label for="data_przejscia">Data przejścia:</label>
        <input type="date" id="data_przejscia" name="data_przejscia" value="<?= $row['data_przejscia'] ?>" required><br>
        <label for="styl_przejscia">Styl przejścia:</label>
        <input type="text" id="styl_przejscia" name="styl_przejscia" value="<?= $row['styl_przejscia'] ?>" required><br>
        <label for="wycena_drogi">Wycena drogi:</label>
        <input type="text" id="wycena_drogi" name="wycena_drogi" value="<?= $row['wycena_drogi'] ?>" required><br>
        <button type="submit">Zapisz</button>
    </form>
</body>

</html>