<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Book List</title>
        <link rel="stylesheet" type="text/css" href="styles/frame.css">
        <link rel="stylesheet" type="text/css" href="styles/list.css">
    </head>
    <body>
        <?php
        include './templates/HeaderNav.php';
        $DB = new mysqli("localhost", "webapp", "webapp", "webapp_class");
        if ($DB->connect_error)
            die($DB->connect_error);
        $query = "SELECT * FROM book_list";
        $result = $DB->query($query);
        $rows = mysqli_fetch_all($result, MYSQLI_BOTH);
        foreach ($rows as $item) {
            $name = $item["name"];
            $author = $item["author"];
            $isbn = $item["isbn"];
            $description = $item["description"];
            $genre = $item["genre_name"];
            $path = $item["image_path"];
            $related_link = $genre != "" ? "<a href='related.php?genre=$genre'>Related books</a>" : "";
            $pic_link = $path != "" ? "<a href='$path'>View</a>" : "";

            $temp .= <<<GETROWS
                    <tr>
                    <td>$name</td>
                    <td>$pic_link</td>
                    <td>$author</td>
                    <td>$isbn</td>
                    <td>$description</td>
                    <td>$genre</td>
                    <td>$related_link</td>
                </tr>
GETROWS;
        }

        echo <<<SHOWBOOKS
        <main>
            <table>
                <tr>
                    <th>Book name</th>
                    <th>Book pic</th>
                    <th>Author</th>
                    <th>ISBN</th>
                    <th>Description</th>
                    <th>Genre</th>
                    <th></th>
                </tr>
        $temp
            </table>
        </main>
SHOWBOOKS;
        include './templates/foot.php';
        ?>
    </body>
</html>