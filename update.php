<?php

require_once "views/partials/dbconnect.php";

$id = $_GET['id'] ?? null;

$error = [];

if (!$id) {
    header("Location: index.php");
    exit;
}

$notes = $pdo->prepare("SELECT * FROM user_note WHERE id = :id");
$notes->bindValue(":id", $id);
$notes->execute();

$note = $notes->fetch(PDO::FETCH_ASSOC);

$title = $note['title'];
$body = $note['body'];

// submit updated data

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $title = $_POST['titleText'];
    $body = $_POST['bodyText'];

    $notes = $pdo->prepare("UPDATE user_note SET title=:title, body=:body WHERE id = :id");
    $notes->bindValue(":title", $title);
    $notes->bindValue(":body", $body);
    $notes->bindValue(":id", $id);


    if (!$body) {
        $error[] = "Please enter note...";
    }

    if (empty($error)) {
        $notes->execute();
        header("Location: index.php");
    }
}

?>


<?php include_once "views/partials/header.php" ?>

<body class="container">
    <nav>
        <h1>NoteApp</h1>
        <a href="index.php" class="btn btn-info">Go back</a>
    </nav>

    <!-- form -->
    <form method="POST" autocomplete="off">
        <!-- print error message -->
        <?php if (!empty($error)) { ?>
            <?php foreach ($error as $err) { ?>
                <div class="alert alert-danger"><?php echo $err ?></div>
            <?php } ?>
        <?php } ?>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Title</label>
            <input type="text" class="form-control" name="titleText" value="<?php echo $title ?>">
            <div class="form-text">Enter a title for your note.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Body</label>
            <textarea type="text" class="form-control" style="height: 350px" name="bodyText"><?php echo $body ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <?php include_once "views/partials/footer.php" ?>
</body>

</html>