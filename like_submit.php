<?php
include("include/db_config.php");

if (empty($_GET) == false) {
    $action = $_GET["action"];
    $comment = $_GET["comment"];
    $num = $_GET["post"];

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if ($conn == false) {
        echo("Connection failed: " . mysqli_connect_error());
    } else {
        $sql_text = "SELECT `likes`, `dislikes` FROM `comments` WHERE `id` = $comment";
        $result = mysqli_query($conn, $sql_text);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $likes = (int) $row["likes"];
                $dislikes = (int) $row["dislikes"];
            }
        } else {
            echo("Error loading");
        }
        if ($action == "like") {
            $likes += 1;
            $sql_text2 = "UPDATE `comments` SET `likes`='$likes' WHERE `id` = $comment";
        }
        if ($action == "dislike") {
            $dislikes += 1;
            $sql_text2 = "UPDATE `comments` SET `dislikes`='$dislikes' WHERE `id` = $comment";
        }
        $result2 = mysqli_query($conn, $sql_text2);
        if ($result2 == true) {
            echo("Thank you!<br>");
            echo("<a href='post.php?num=$num'>Back to post</a><br>\n");
        } else {
            echo("Error: " . $sql . "<br>" . mysqli_error($conn) . "<br>\n");
            echo("<a href='post.php?num=$num'>Back to post</a><br>\n");
        }
    }
} else {
    echo("Error getting data");
}

?>