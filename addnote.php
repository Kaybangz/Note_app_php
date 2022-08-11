<?php

require_once "views/partials/dbconnect.php";

$error = [];

$title = "";
$body = "";

if($_SERVER['REQUEST_METHOD'] === "POST"){

    $title = $_POST['titleText'];
    $body = $_POST['bodyText'];

    // $date = date("F j, Y, g:i a");
    $date = date("Y:m:d H:i:s");
    // $date = date("D M j G:i:s T Y");

    
    if(empty($body)){
        $error[] = "Please enter a note...";
    }

    if(empty($error)){
        $notes = $pdo->prepare("INSERT INTO user_note (title, body, create_date) VALUES (:title, :body, :date)");

        $notes->bindValue(":title", $title);
        $notes->bindValue(":body", $body);
        $notes->bindValue(":date", $date);

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
        <?php if(!empty($error)){ ?>
            <?php foreach($error as $err){ ?>
                <div class="alert alert-danger"><?php echo $err ?></div>
            <?php } ?>
        <?php } ?>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Title</label>
            <input type="text" class="form-control" name="titleText" value="<?php echo $title ?>">
            <div class="form-text">A title for your note is important to help you search for it.</div>
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