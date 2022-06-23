<?php
include("include/header.php");
include_once("include/db_config.php");
include("include/functions.php");
include("include/sign_in_form.php");
include("include/menu.php");
?>
<center><h1>All posts</h1></center>
<?php
$conn = mysqli_connect($servername, $username, $password, $dbname);
$sql_text = "SELECT `id`, `title` FROM `posts` WHERE `status` = '2'";
echo("<h3>Posts:</h3>");
load_post_list($conn, $sql_text);
mysqli_close($conn);
include("include/footer.php");
?>