<h3>Menu</h3>
<ul>
    <?php   
    echo("<li><a href='" . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST']. "/'>Main page</a></li>\n");
    echo("<li><a href='" . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST']. "/posts.php'>All posts</a></li>\n");
    ?>
</ul>