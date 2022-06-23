<?php
if (isset($_COOKIE['user_name']) && isset($_COOKIE['user_role'])) {
    $_SESSION['user_name'] = $_COOKIE['user_name'];
    $_SESSION['user_role'] = $_COOKIE['user_role'];
}
if (isset($_SESSION['user_name']) && isset($_SESSION['user_role'])) {
    $user_name = $_SESSION['user_name'];
    $user_role = $_SESSION['user_role'];
    echo("You are logged in as $user_name<br>\n");
    if ($user_role == 1) {
        $place = $_SERVER['REQUEST_URI'];
        $place_arr = explode('?', $place);
        $place = $place_arr[0];
        if($place == "/admin/") {
            echo("You are administrator. <a href='" . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST']. "'>Retutn to website</a>.");
        } else {
            echo("You are administrator. <a href='" . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST']. "/admin/'>Go to Administrator panel</a>.");
        }
    }
    ?>
    <form method="post" action="<?php echo($_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/"); ?>sign_in.php">
        <input type="hidden" name="sign_out_button" value="out">
        <input type="submit"  value="Log out">
    </form>
    <?php
} else {
    ?>
    <form method="post" action="<?php echo($_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/"); ?>sign_in.php">
        <input name="sign_in_login" placeholder="Login" required><br>
        <input type="password" name="sign_in_password" placeholder="Password" required><br>
        <input type="submit"  value="Log in"><input type="reset" value="Clear">
    </form>
    <?php
    echo("You are not logged in<br>");
}
?>