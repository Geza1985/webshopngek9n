<?php
function getDB() {
    return new PDO(
        'mysql:host=sql102.infinityfree.com;dbname=if0_38900826_pcparts;charset=utf8',
        'if0_38900826',
        'uqCnPTEzuDqei',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
}

