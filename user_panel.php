<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM przejscia JOIN przejscia_uzytkownicy ON przejscia.id = przejscia_uzytkownicy.id_przejscia WHERE przejscia_uzytkownicy.id_uzytkownika = $user_id ORDER BY data_przejscia DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>Panel użytkownika</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h2>Lista przejść</h2>
    <table>
        <tr>
            <th>Nazwa drogi</th>
            <th>Data przejścia</th>
            <th>Styl przejścia</th>
            <th>Wycena drogi</th>
            <th></th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= htmlspecialchars($row['nazwa_drogi']) ?></td>
                <td><?= htmlspecialchars($row['data_przejscia']) ?></td>
                <td><?= htmlspecialchars($row['styl_przejscia']) ?></td>
                <td><?= htmlspecialchars($row['wycena_drogi']) ?></td>
                <td style="width: 124px;">
                    <a class="action_btn" id="edit_btn" href="edit_passage.php?id=<?= $row['id'] ?>">Edytuj</a>
                    &nbsp;
                    <a class="action_btn" id="del_btn" href="delete_passage.php?id=<?= $row['id'] ?>">Usuń</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    <h3>Dodaj przejście</h3>
    <form action="add_passage.php" method="post">
        <label for="nazwa_drogi">Nazwa drogi:</label>
        <input type="text" id="nazwa_drogi" name="nazwa_drogi" required><br>
        <label for="data_przejscia">Data przejścia:</label>
        <input type="date" id="data_przejscia" name="data_przejscia" required><br>
        <label for="styl_przejscia">Styl przejścia:</label>
        <input type="text" id="styl_przejscia" name="styl_przejscia" required><br>
        <label for="wycena_drogi">Wycena drogi:</label>
        <input type="text" id="wycena_drogi" name="wycena_drogi" required><br>
        <button type="submit">Dodaj</button>
    </form>
    <br>
    <a href="logout.php">Wyloguj</a>
</body>

</html>