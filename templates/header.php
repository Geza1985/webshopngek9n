<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>PCParts MiniShop</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
    <h1>PCParts MiniShop</h1>
    <nav>
        <ul>
            <?php
            foreach ($menu as $key => $value) {
                echo "<li><a href='index.php?page=$key'>$value</a></li>";
            }

            if (isset($_SESSION['user'])) {
                echo "<li><a href='index.php?page=logout'>Kilépés</a></li>";
                echo "<li>Bejelentkezett: {$_SESSION['user']['name']}</li>";
            } else {
                echo "<li><a href='index.php?page=login'>Belépés</a></li>";
            }
            ?>
        </ul>
    </nav>
</header>
<main>
