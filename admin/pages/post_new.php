<center><h1>Create new post</h1></center>
<form action="post_new_submit.php" method="post">
    <input name="title" placeholder="Post title" style="width:100%" required><br>
    <textarea type="text" name="txtarea" placeholder="Post text" style="width:100%;height:30vh" required></textarea><br>
    <input type="text" name="state" id="state" list="state_list"  required>
    <?php
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if ($conn == false) {
        echo("<h5>Connection to DB failed: " . mysqli_connect_error() . "</h5>\n");
    } else {
        $sql_text = "SELECT * FROM `posts_statuses`";
        $result = mysqli_query($conn, $sql_text);
        if (mysqli_num_rows($result) > 0) {
            echo("<datalist id='state_list'>");
            while($row = mysqli_fetch_assoc($result)) {
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
    <input type="submit" value="Create new post">
</form>
<?php

mysqli_close($conn);
?>
