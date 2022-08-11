<?php

require_once "views/partials/dbconnect.php";


$search = $_GET['search'] ?? "";


if ($search) {
    $result = $pdo->prepare("SELECT * FROM user_note WHERE title LIKE :title ORDER BY create_date DESC");
    $result->bindValue(":title", "%$search%");
} else {
    $result = $pdo->prepare("SELECT * FROM user_note ORDER BY create_date DESC");
}


$result->execute();

$notes = $result->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include_once "views/partials/header.php" ?>
    <nav>
        <h1>NoteApp</h1>
        <a href="addnote.php" class="btn btn-info">Add new note</a>
    </nav>
    <form>
        <span class="input-group mb-3 searchbar">
            <input type="text" class="form-control" placeholder="Search for note by title..." name="search">
            <button type="submit" class="btn btn-outline-info" type="button" id="button-addon2">Search</button>
        </span>
    </form>


    <?php foreach ($notes as $note) { ?>
        <div class="note_container">

            <div class="note_content">
                <p><?php echo $note['create_date'] ?></p>
                <span class="text_container">
                    <h4><?php echo $note['title'] ?></h4>
                    <p><?php echo $note['body'] ?></p>
                </span>


                <span class="icons_container">
                    <a href="viewnote.php?id=<?php echo $note['id'] ?>" class="btn btn-outline-primary mx-1">
                        <ion-icon class="icon" style="font-size: 23px;" name="eye-outline"></ion-icon>
                    </a>

                    <a href="update.php?id=<?php echo $note["id"] ?>" class="btn btn-outline-secondary mx-1">
                        <ion-icon class="icon" style="font-size: 23px;" name="create-outline"></ion-icon>
                    </a>

                    <form action="delete.php" method="POST" style="display: inline-block;">
                        <input type="hidden" value="<?php echo $note['id'] ?>" name="id">
                        <button class="btn btn-outline-danger mx-1" type="submit">
                            <ion-icon class="icon" style="font-size: 23px;" name="trash-outline"></ion-icon>
                        </button>
                    </form>
                </span>

            </div>
        </div>
    <?php } ?>



    <?php include_once "views/partials/footer.php" ?>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>