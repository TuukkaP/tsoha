<?php
try {
    $yhteys = new PDO("pgsql:host=localhost;dbname=ivahamaa",
                      "ivahamaa", "SALASANA");
} catch (PDOException $e) {
    die("VIRHE: " . $e->getMessage());
}
$yhteys->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
