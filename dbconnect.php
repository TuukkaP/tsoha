<?php
try {

    $pdo = new PDO('pgsql:host=localhost;dbname=ivahamaa','ivahamaa', 'kaljakori');

} catch (PDOException $e) {
    die("VIRHE: " . $e->getMessage());
}
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

