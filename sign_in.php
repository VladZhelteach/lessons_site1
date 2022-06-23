<?php
include("include/db_config.php");

function show_menu_back() {
?>
<ul>
    <li><a href='/'>Main page</a></li>
    <li><a href="#" onclick="history.back();">Back</a></li>
</ul>
<?php
}

//if (empty($_POST) == false) {
if (isset($_POST["sign_in_login"]) && isset($_POST["sign_in_password"])) {
    $sign_in_login = $_POST["sign_in_login"];
    $sign_in_password = $_POST["sign_in_password"];
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if ($conn == false) {
        echo("Connection failed: " . mysqli_connect_error());
    } else {
        $sql_text = "SELECT * FROM `users` WHERE `username` = '$sign_in_login'";
        $result = mysqli_query($conn, $sql_text);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                if ($row["username"] == $sign_in_login && $row["password"] == MD5($sign_in_password)) {
                    $ses_user_name = $row["username"];
                    $ses_user_role = $row["role"];
                    $_SESSION['user_name'] = $ses_user_name;
                    $_SESSION['user_role'] = $ses_user_role;
                    setcookie('user_name', $ses_user_name, time()+3600*24*30);
                    setcookie('user_role', $ses_user_role, time()+3600*24*30);
                    echo("Successfully logged in<br>");
                    show_menu_back();
                } else {
                    echo("Password incorrect<br>");
                    show_menu_back();
                }
            }
        }
    }
}
//}

if (isset($_POST["sign_out_button"])) {
    if ($_POST["sign_out_button"] == "out") {
        session_destroy();
        setcookie ("user_name", "", time() - 3600);
        setcookie ("user_role", "", time() - 3600);
        echo("Successfully logged out<br>");
        show_menu_back();
    }
}

?>