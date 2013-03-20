<?php
try {
    $pdo = new PDO('pgsql:host=localhost;dbname=peuranie', 'peuranie', 'caa0b83bc9393e6e');
} catch (PDOException $e) {
    die("VIRHE: " . $e->getMessage());
}
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

