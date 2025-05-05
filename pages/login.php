<?php
require_once("core/functions.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $db = getDB();
    $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = [
            'name' => $user['lastname'] . ' ' . $user['firstname'],
            'username' => $user['username']
        ];
        header("Location: index.php");
        exit;
    } else {
        echo "<p>Hibás felhasználónév vagy jelszó!</p>";
    }
}
?>

<h2>Belépés</h2>
<form method="POST">
    <input type="text" name="username" placeholder="Felhasználónév" required><br>
    <input type="password" name="password" placeholder="Jelszó" required><br>
    <button type="submit">Belépés</button>
</form>
<p><a href='index.php?page=register'>Regisztráció</a></p>
