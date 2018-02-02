<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>The book has been added to the wishlist</title>
        <link rel="stylesheet" type="text/css" href="styles/frame.css">
        <link rel="stylesheet" type="text/css" href="styles/confirm.css">
    </head>
    <body>
        <?php
        include './templates/HeaderNav.php';
        
        $book_name = $_POST["name"];
        $book_author = $_POST["author"];
        $book_genre = $_POST["genre"];
        $book_isbn = $_POST["isbn"];
        $book_description = $_POST["description"];
        $mysql = new mysqli("localhost", "webapp", "webapp", "webapp_class");
        
        //check if a user tries to enter a book with an existing ISBN
        $q = $mysql->query("SELECT isbn FROM books");
        $a = mysqli_fetch_all($q);
        foreach ($a as $row) {
            if ($row[0] == "")
                continue;
            if ($row[0] == $book_isbn) {
                echo <<<ERR
        <main>
            <h3>Error message: Enter a book with an existing ISBN</h3>
            <h3>Redirect to HOME in 5 seconds...</h3>
        </main>
ERR;
                header("refresh:5;url=index.php");
                exit();
            }
        }
        
        //upload images to folder
        $image = $_FILES["image"];
        $size = getimagesize($image["tmp_name"]);
        if ($size) {
            $path = "images/" . $image["name"];
            move_uploaded_file($image["tmp_name"], $path);
        }

        if ($book_genre == NULL || $book_genre == "")
            $q = $mysql->query("INSERT INTO `books`(`name`, `author`, `isbn`, `description`, image_path) VALUES ('$book_name','$book_author','$book_isbn','$book_description','$path')");
        else
            $q = $mysql->query("INSERT INTO `books`(`name`, `author`, `isbn`, `description`, `genre_id`, image_path) VALUES ('$book_name','$book_author','$book_isbn','$book_description',$book_genre,'$path')");
        if ($mysql->error)
            echo $mysql->error;
        $mysql->close();
        echo <<<CONTENT
        <main>
            <h3>$book_name has been added to the wishlist.</h3>
            <h3>Redirect to HOME in 5 seconds...</h3>
        </main>
CONTENT;
        include './templates/foot.php';
        header("refresh:5;url=index.php");
        ?>
    </body>
</html>