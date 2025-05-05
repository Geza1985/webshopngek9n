<?php
require_once("core/functions.php");

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $message = trim($_POST["message"]);

    // Szerveroldali validáció
    if (empty($name) || empty($email) || empty($message)) {
        $error = "Minden mező kitöltése kötelező!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Érvénytelen e-mail cím!";
    } else {
        $db = getDB();
        $sender = isset($_SESSION['user']) ? $_SESSION['user']['username'] : 'Vendég';
        $stmt = $db->prepare("INSERT INTO messages (name, email, message, sender) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $message, $sender]);
        $success = "Üzenet sikeresen elküldve!";
    }
}
?>

<h2>Kapcsolat</h2>

<?php if ($error): ?>
    <p style="color:red;"><?= $error ?></p>
<?php elseif ($success): ?>
    <p style="color:green;"><?= $success ?></p>
<?php endif; ?>

<form method="POST" onsubmit="return validateContactForm();">
    <input type="text" name="name" placeholder="Név"><br>
    <input type="text" name="email" placeholder="E-mail"><br>
    <textarea name="message" placeholder="Üzenet szövege..."></textarea><br>
    <button type="submit">Küldés</button>
</form>

<script src="js/validation.js"></script>
