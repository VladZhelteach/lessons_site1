<center><h1>All posts</h1></center>
<?php

function show_table_header() {
    ?>
    <table class="table table-striped">
    <tr>
        <th>ID</th>
        <th>Author</th>
        <th>Title</th>
        <th>Date of publication</th>
        <th>Date of last update</th>
        <th>Status</th>
        <th>Edit</th>
    </tr>
    <?php
}

function show_table_content($result) {
    while($row = mysqli_fetch_assoc($result)) {
        $num = $row["id"];
        $author = $row["author"];
        $name = $row["title"];
        $date_publ = $row["date_publ"];
        $last_update = $row["last_update"];
        $status = $row["status"];
        echo("<tr>\n<td>$num</td>\n<td>$author</td>\n<td>$name</td>\n<td>$date_publ</td>\n<td>$last_update</td>\n<td>$status</td>\n");
        echo("<td><a href='?page=edit_post&post_id=$num'>Link</a></td>\n");
        echo("</tr>\n");

    }
    echo("</table>");
}

$conn = mysqli_connect($servername, $username, $password, $dbname);
if ($conn == false) {
    echo("Connection failed: " . mysqli_connect_error());
} else {
    $sql_text_publ = "SELECT * FROM `posts` WHERE `status` = '2'";
    $result_publ = mysqli_query($conn, $sql_text_publ);
    if (mysqli_num_rows($result_publ) > 0) {
        echo("<h3>Published:</h3>");
        show_table_header();
        show_table_content($result_publ);
    } else {
        echo("<h3>No published posts!</h3>");
    }
    $sql_text_draft = "SELECT * FROM `posts` WHERE `status` = '1'";
    $result_draft = mysqli_query($conn, $sql_text_draft);
    if (mysqli_num_rows($result_draft) > 0) {
        echo("<h3>Drafts:</h3>");
        show_table_header();
        show_table_content($result_draft);
    } else {
        echo("<h3>No drafts!</h3>");
    }
    $sql_text_hidn = "SELECT * FROM `posts` WHERE `status` = '3'";
    $result_hidn = mysqli_query($conn, $sql_text_hidn);
    if (mysqli_num_rows($result_hidn) > 0) {
        echo("<h3>Hidden:</h3>");
        show_table_header();
        show_table_content($result_hidn);
    } else {
        echo("<h3>No hidden posts!</h3>");
    }
}
mysqli_close($conn);
?>