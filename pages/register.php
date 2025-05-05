<?php
require_once("core/functions.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $db = getDB();
    $stmt = $db->prepare("INSERT INTO users (lastname, firstname, username, password) VALUES (?, ?, ?, ?)");
    try {
        $stmt->execute([$lastname, $firstname, $username, $password]);
        echo "<p>Sikeres regisztráció! <a href='index.php?page=login'>Lépj be itt</a>.</p>";
    } catch (PDOException $e) {
        echo "<p>Hiba: felhasználónév már létezik.</p>";
    }
}
?>

<h2>Regisztráció</h2>
<form method="POST">
    <input type="text" name="lastname" placeholder="Vezetéknév" required><br>
    <input type="text" name="firstname" placeholder="Keresztnév" required><br>
    <input type="text" name="username" placeholder="Felhasználónév" required><br>
    <input type="password" name="password" placeholder="Jelszó" required><br>
    <button type="submit">Regisztráció</button>
</form>
