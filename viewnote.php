<?php

require_once "views/partials/dbconnect.php";

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: index.php");
}

$notes = $pdo->prepare("SELECT * FROM user_note WHERE id = :id");
$notes->bindValue(":id", $id);

$notes->execute();


$note = $notes->fetch(PDO::FETCH_ASSOC);

// echo "<pre>";
// var_dump($note);
// echo "</pre>";
// exit;

?>




<?php include_once "views/partials/header.php" ?>

<body class="container">
    <nav>
        <h1>NoteApp</h1>
        <a href="index.php" class="btn btn-info">Go back</a>
    </nav>

    <div>
        <h3><?php echo $note['title'] ?></h3>
        <p><?php echo $note['create_date'] ?></p>
    </div>

    <p><?php echo $note['body'] ?></p>

    <?php include_once "views/partials/footer.php" ?>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>