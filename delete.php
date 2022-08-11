<?php 

require_once "views/partials/dbconnect.php";

$id = $_POST['id'] ?? null;

if(!$id){
    header("Location: index.php");
}

$notes = $pdo->prepare("DELETE FROM user_note WHERE id = :id");
$notes->bindValue(":id", $id);
$notes->execute();
header("Location: index.php");
?>
