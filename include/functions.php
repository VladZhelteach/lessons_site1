<?php
function load_post_list($conn, $sql_text) {
    if ($conn == false) {
        echo("Connection failed: " . mysqli_connect_error());
    } else {
        $result = mysqli_query($conn, $sql_text);
        if (mysqli_num_rows($result) > 0) {
            echo("<ol>");
            while($row = mysqli_fetch_assoc($result)) {
                $num = $row["id"];
                $name = $row["title"];
                echo("<li><a href='" . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST']. "/post.php?num=$num'>$name</a></li>\n");
            }
            echo("</ol>");
        }
    }
}
?>