<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Create a book</title>
        <link rel="stylesheet" type="text/css" href="styles/frame.css">
        <link rel="stylesheet" type="text/css" href="styles/create.css">
        <script>
            function formValidation() {
                //for required field
                var name = document.getElementById("name").value;
                var author = document.getElementById("author").value;
                if (name == "" || author == "") {
                    window.alert("Name and author are required!");
                    return false;
                }
            }
        </script>
    </head>
    <body>
        <?php
        include './templates/HeaderNav.php';
        echo<<<SUB
        <main>
            <form action="confirm.php" enctype="multipart/form-data" onsubmit="return formValidation()" method="post">
            Book Name: <br>
            <input type="text" name="name" id="name"><br>
            Author: <br>
            <input type="text" name="author"id="author"><br>
                Genre: <br>
                <input type="radio" name="genre" value="1">
                non-fiction
                <input type="radio" name="genre" value="2">
                horror
                <input type="radio" name="genre" value="3">
                mystery
                <input type="radio" name="genre" value="4">
                classic
                <input type="radio" name="genre" value="5">
                other
                <br>
                ISBN: <br>
                <input type="number" name="isbn"><br>
                Description: <br>
                <textarea name="description" cols="30" rows="3"></textarea><br>
                Picture: (Other types won't be uploaded.)<br>
                <input type="file" name="image"><br><br>
                <input type="submit">
            </form>
        </main>
SUB;
        include './templates/foot.php';
        ?>
    </body>
</html>
