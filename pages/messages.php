<?php
require_once("core/functions.php");

if (!isset($_SESSION['user'])) {
    echo "<p style='color:red;'>Ez az oldal csak bejelentkezett felhasználóknak érhető el.</p>";
    return;
}

$db = getDB();
$messages = $db->query("SELECT * FROM messages ORDER BY sent_at DESC")->fetchAll();
?>

<h2>Beküldött üzenetek</h2>

<?php if (empty($messages)): ?>
    <p>Nincs még üzenet.</p>
<?php else: ?>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>Név</th>
            <th>E-mail</th>
            <th>Üzenet</th>
            <th>Időpont</th>
            <th>Küldő</th>
        </tr>
        <?php foreach ($messages as $msg): ?>
            <tr>
                <td><?= htmlspecialchars($msg['name']) ?></td>
                <td><?= htmlspecialchars($msg['email']) ?></td>
                <td><?= nl2br(htmlspecialchars($msg['message'])) ?></td>
                <td><?= $msg['sent_at'] ?></td>
                <td><?= $msg['sender'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
