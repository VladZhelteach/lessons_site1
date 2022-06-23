<?php
include("../include/header.php");
include_once("../include/db_config.php");
include("../include/functions.php");
include("../include/sign_in_form.php");

if (isset($_SESSION['user_name']) && isset($_SESSION['user_role'])) {
    if ($_SESSION['user_role'] == 1) {
        echo("<center><h1>Administration Panel</h1></center>");
        include("include/menu.php");
        if(isset($_GET["page"])) {
            $page = $_GET["page"];
            switch ($page) {
                case '':
                    include("pages/main.php");
                    break;
                case 'new_post':
                    include("pages/post_new.php");
                    break;
                case 'all_posts':
                    include("pages/posts.php");
                    break;
                case 'edit_post':
                    include("pages/post_edit.php");
                    break;
                default:
                include("pages/404.php");
                    break;
            } 
        } else {
            include("pages/main.php");
        } 
    } else {
        echo("Only administrator can view this page!");
    }
} else {
    echo("Only authorized administrator can view this page!");
}
include("../include/footer.php");
?>
