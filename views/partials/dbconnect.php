<?php

$pdo = new PDO("mysql:hostname=localhost;port=3306;dbname=note_app", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>