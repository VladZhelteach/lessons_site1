<?php
include_once("../include/db_config.php");
include("include/functions.php");

if (empty($_POST) == false) {
  if (isset($_SESSION['user_name']) && isset($_POST["title"]) && isset($_POST["txtarea"]) && isset($_POST["state"])) {
    $name = $_SESSION['user_name'];
    $post_id = htmlspecialchars($_POST["post_id"]);
    $post_author = htmlspecialchars($_POST["post_author"]);
    $title = htmlspecialchars($_POST["title"]);
    $txtarea = htmlspecialchars($_POST["txtarea"]);
    $state = htmlspecialchars($_POST["state"]);
    $last_update = date('Y-m-d H:i:s');

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if ($conn == false) {
      echo("Connection failed: " . mysqli_connect_error());
    } else {
      $sql = "UPDATE `posts` SET `title`=\"$title\", `author`=\"$post_author\", `text`=\"$txtarea\", `status`=\"$state\", `last_update`=\"$last_update\" WHERE `id` = \"$post_id\"";
      $result = mysqli_query($conn, $sql);
      if ($result == true) {
          echo("POST updated successfully<br>");
          show_links();
      } else {
          echo("Error: " . $sql . "<br>" . mysqli_error($conn) . "<br>\n");
          show_links();
      }
    }
  } else {
    echo("Error getting data<br>\n");
    show_links();
  }
} else {
  echo("Error getting data<br>\n");
  show_links();
}
?>