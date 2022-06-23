<?php
if (isset($_GET["post_id"])) {
    $post_id = $_GET["post_id"];
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if ($conn == false) {
        echo("<h5>Connection to DB failed: " . mysqli_connect_error() . "</h5>\n");
    } else {
        $sql_text = "SELECT * FROM `posts` WHERE `id` = '$post_id'";
        $result = mysqli_query($conn, $sql_text);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $post_date = $row["date_publ"];
                $post_title = $row["title"];
                $post_text = $row["text"];
                $post_status = $row["status"];
            }
        } else {
            echo("Error loading post data<br>\n");
        }
    }
    ?>
    <center><h1>Edit post</h1></center>
    <form action="post_upd.php" method="post">
        <input name="post_id" type="hidden" value="<?php echo("$post_id"); ?>">
        <input name="title" placeholder="Post title" style="width:100%" value="<?php echo("$post_title"); ?>" required><br>
        <textarea type="text" name="txtarea" placeholder="Post text" style="width:100%;height:30vh" required><?php echo("$post_text"); ?></textarea><br>
        <input type="text" name="state" id="state" list="state_list" value="<?php echo("$post_status"); ?>" required>
        <?php
        if ($conn == false) {
            echo("<h5>Connection to DB failed: " . mysqli_connect_error() . "</h5>\n");
        } else {
            $sql_text2 = "SELECT * FROM `posts_statuses`";
            $result2 = mysqli_query($conn, $sql_text2);
            if (mysqli_num_rows($result2) > 0) {
                echo("<datalist id='state_list'>");
                while($row = mysqli_fetch_assoc($result2)) {
                    $stat_id = $row["id"];
                    $status = $row["status"];
                    echo("<option value='$stat_id'>$status</option>\n");
                }
                echo("</datalist>");
            } else {
                echo("<input type='number' id='tentacles' name='tentacles' min='10' max='100'>\n");
            }
        }
        ?>
        <input type="submit" value="Edit post">
    </form>
    <?php
    mysqli_close($conn);
} else {
    echo("Error getting post number!");
}
?>