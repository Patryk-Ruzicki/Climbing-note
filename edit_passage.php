<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$passage_id = intval($_GET['id']);
$query = "SELECT * FROM przejscia WHERE id = $passage_id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
        <input type="text" id="nazwa_drogi" name="nazwa_drogi" value="<?= htmlspecialchars($row['nazwa_drogi']) ?>"
            required><br>
        <label for="data_przejscia">Data przejścia:</label>
        <input type="date" id="data_przejscia" name="data_przejscia"
            value="<?= htmlspecialchars($row['data_przejscia']) ?>" required><br>
        <label for="styl_przejscia">Styl przejścia:</label>
        <input type="text" id="styl_przejscia" name="styl_przejscia"
            value="<?= htmlspecialchars($row['styl_przejscia']) ?>" required><br>
        <label for="wycena_drogi">Wycena drogi:</label>
        <input type="text" id="wycena_drogi" name="wycena_drogi" value="<?= htmlspecialchars($row['wycena_drogi']) ?>"
            required><br>
        <button type="submit">Zapisz</button>
    </form>
</body>

</html>