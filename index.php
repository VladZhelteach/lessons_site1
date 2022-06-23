<?php
include("include/header.php");
include_once("include/db_config.php");
include("include/functions.php");
include("include/sign_in_form.php");
include("include/menu.php");
?>
<center><h1>Blog website</h1></center>
Menu:<br>
<a href="<?php echo($_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST']. "/"); ?>posts.php">All posts</a>
<hr>
Top 3 posts:
<?php
$conn = mysqli_connect($servername, $username, $password, $dbname);
$sql_text = "SELECT `id`, `title` FROM `posts` WHERE `status` = '2' ORDER BY `id` DESC LIMIT 3";
load_post_list($conn, $sql_text);
mysqli_close($conn);
include("include/footer.php");
?>


