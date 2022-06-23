<?php
include("include/header.php");
include_once("include/db_config.php");
include("include/functions.php");
include("include/sign_in_form.php");
include("include/menu.php");

if (is_null($_GET["num"])) {
    $num = 0;
} else {
    $num = $_GET["num"];
}

if ($num == 0) {
    echo("No post selected to show!");
} else {   
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        echo("Connection failed: " . mysqli_connect_error());
    } else {
        $sql_text = "SELECT * FROM `posts` WHERE `id` = $num";
        $result = mysqli_query($conn, $sql_text);
        if (mysqli_num_rows($result) > 0) {
            echo("<h3>Post:</h3>");
            while($row = mysqli_fetch_assoc($result)) {
                //echo($row["id"] . "<br>\n");
                echo("<b>" . $row["title"] . "</b><br>\n");
                echo($row["author"] . "<br>\n");
                echo($row["date_publ"] . "<br>\n"); 
                echo($row["text"] . "<br>\n");
            }
        } else {
            echo("Error loading post<br>\n");
        }
?>
<h3>Comments:</h3>
<form action="comment_submit.php" method="post">
<input name="post" type="hidden" value="<?php echo("$num"); ?>"><br>
<input name="name" placeholder="Name"><br>
<input name="title" placeholder="Title"><br>
<textarea name="comment" placeholder="Message" cols="50" rows="7"></textarea><br>
<input type="submit">
<input type="reset">
</form>
<hr>
<?php
        $sql_text2 = "SELECT * FROM `comments` WHERE `post_id` = $num";
        $result2 = mysqli_query($conn, $sql_text2);
        if (mysqli_num_rows($result2) > 0) {
            while($row = mysqli_fetch_assoc($result2)) {
                //echo($row["id"] . "<br>\n");
                echo("<b>" . $row["author"] . "</b><br>\n");
                echo($row["date_publ"] . "<br>\n");
                echo("<u>" . $row["title"] . "</u><br>\n");
                echo($row["comment"] . "<br>\n");
                echo("<a href='like_submit.php?action=like&comment=" . $row["id"] . "&post=$num'><img src='files/img/like_icon.png' width='20px'> " . $row["likes"] . "</a> \n");
                echo("<a href='like_submit.php?action=dislike&comment=" . $row["id"] . "&post=$num'><img src='files/img/dislike_icon.png' width='20px'> " . $row["dislikes"] . "</a><br>\n");
                echo("<hr>\n");
            }
        } else {
            echo("No comments found!<br>\n");
        }
    }
    mysqli_close($conn); 
}
include("include/footer.php");
?>