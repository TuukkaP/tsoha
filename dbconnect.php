<?php
try {
    $pdo = new PDO(pgsql:host=localhost;dbname=ivahamaa",
                      "ivahamaa", "49fbd656411c2b0d");
} catch (PDOException $e) {
    die("VIRHE: " . $e->getMessage());
}
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

