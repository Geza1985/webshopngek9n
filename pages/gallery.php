<?php
require_once("core/functions.php");

$db = getDB();

// Feltöltés – csak belépett felhasználónak
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user'])) {
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $targetDir = "uploads/gallery/";
        $filename = basename($_FILES['image']['name']);
        $targetFile = $targetDir . $filename;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            try {
                $stmt = $db->prepare("INSERT INTO gallery (filename) VALUES (?)");
                $stmt->execute([$filename]);
                echo "<p style='color:green;'>✅ Kép feltöltve és elmentve!</p>";
            } catch (PDOException $e) {
                echo "<p style='color:red;'>❌ HIBA: " . $e->getMessage() . "</p>";
            }
        } else {
            echo "<p style='color:red;'>❌ Hiba történt a fájl mentésekor.</p>";
        }
    }
}

// Képek lekérése
try {
    $images = $db->query("SELECT * FROM gallery ORDER BY uploaded_at DESC")->fetchAll();
} catch (PDOException $e) {
    echo "<p style='color:red;'>❌ Galéria betöltési hiba: " . $e->getMessage() . "</p>";
    $images = [];
}
?>

<h2>Képgaléria</h2>

<?php if (isset($_SESSION['user'])): ?>
<form method="POST" enctype="multipart/form-data">
    <input type="file" name="image" accept="image/*" required>
    <button type="submit">Feltöltés</button>
</form>
<?php else: ?>
<p>🔒 Csak bejelentkezve lehet képet feltölteni.</p>
<?php endif; ?>

<hr>

<div style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 20px;">
    <?php foreach ($images as $img): ?>
        <div style="width: 200px; border: 1px solid #ccc; padding: 5px;">
            <img src="uploads/gallery/<?= htmlspecialchars($img['filename']) ?>" alt="Kép" style="width: 100%;">
            <small>📅 Feltöltve: <?= $img['uploaded_at'] ?></small>
        </div>
    <?php endforeach; ?>
</div>
