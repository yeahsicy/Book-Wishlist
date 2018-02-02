<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Related books</title>
        <link type="text/css" rel="stylesheet" href="styles/frame.css">
        <link type="text/css" rel="stylesheet" href="styles/list.css">
    </head>
    <body>
        <?php
        include './templates/HeaderNav.php';
        $genre = $_GET["genre"];
        $DB = new mysqli("localhost", "webapp", "webapp", "webapp_class");
        $result = $DB->query("SELECT * FROM book_list WHERE genre_name ='$genre'");
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        foreach ($rows as $item) {
            $name = $item["name"];
            $author = $item["author"];
            $isbn = $item["isbn"];
            $description = $item["description"];
            $path = $item["image_path"];
            $pic_link = $path != "" ? "<a href='$path'>View</a>" : "";
            
            $temp .= <<<FLITERROWS
                    <tr>
                    <td>$name</td>
                    <td>$pic_link</td>
                    <td>$author</td>
                    <td>$isbn</td>
                    <td>$description</td>
                    <td>$genre</td>
                </tr>
FLITERROWS;
        }
        echo <<<FILTERSHOW
            <main>
            <table>
                <tr>
                    <th>Book name</th>
                    <th>Book pic</th>
                    <th>Author</th>
                    <th>ISBN</th>
                    <th>Description</th>
                    <th>Genre</th>
                </tr>
                $temp
            </table>
        </main>
FILTERSHOW;
        include './templates/foot.php';
        ?>
    </body>
</html>
