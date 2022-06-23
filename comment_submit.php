<?php
include("include/db_config.php");

if (empty($_POST) == false) {
    $post = $_POST["post"];
    $name = htmlspecialchars($_POST["name"]);
    $title = htmlspecialchars($_POST["title"]);
    $comment = htmlspecialchars($_POST["comment"]);
    $datetime = date('Y-m-d H:i:s');

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if ($conn == false) {
        echo("Connection failed: " . mysqli_connect_error());
    } else {
        $sql = "INSERT INTO `comments`(`post_id`, `author`, `date_publ`, `title`, `comment`, `likes`, `dislikes`) VALUES (\"$post\", \"$name\", \"$datetime\", \"$title\", \"$comment\", \"0\", \"0\")";
        $result = mysqli_query($conn, $sql);
        if ($result == true) {
            echo("New comment created successfully<br>");
            echo("<a href='post.php?num=$post'>Back to post</a><br>\n");
        } else {
            echo("Error: " . $sql . "<br>" . mysqli_error($conn) . "<br>\n");
            echo("<a href='post.php?num=$post'>Back to post</a><br>\n");
        }
    }
} else {
    echo("Error getting data");
}

?>