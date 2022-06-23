<center><h1>All posts</h1></center>
<?php
include("../include/db_config.php");
include("../include/functions.php");
include("../include/sign_in_form.php");

$conn = mysqli_connect($servername, $username, $password, $dbname);
$sql_text = "SELECT * FROM `users`";
echo("<h3>Posts:</h3>");
if ($conn == false) {
    echo("Connection failed: " . mysqli_connect_error());
} else {
    $result = mysqli_query($conn, $sql_text);
    if (mysqli_num_rows($result) > 0) {
        ?>
        <table border="1">
        <tr>
            <th>ID</th>
            <th>User name</th>
            <th>Role</th>
            <th>Date of registration</th>
            <th>Date of last login</th>
        </tr>
        <?php
        while($row = mysqli_fetch_assoc($result)) {
            $num = $row["id"];
            $username = $row["username"];
            $role = $row["role"];
            $date_reg = $row["date_reg"];
            $last_login = $row["last_login"];
            echo("<tr>\n<td>$num</td>\n<td>$username</td>\n<td>$role</td>\n<td>$date_reg</td>\n<td>$last_login</td>\n</tr>\n");
        }
        echo("</table>");
    }
}
mysqli_close($conn);
?>