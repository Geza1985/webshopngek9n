<?php
function getDB() {
    try {
        return new PDO(
            'mysql:host=localhost;dbname=pcparts;charset=utf8',
            'root', // felhasználónév
            '',     // jelszó (alapértelmezés szerint üres XAMPP-ben)
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );
    } catch (PDOException $e) {
        die("Adatbázis kapcsolat hiba: " . $e->getMessage());
    }
}
