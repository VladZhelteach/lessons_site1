<?php
include_once("../include/db_config.php");
include("include/functions.php");

if (empty($_POST) == false) {
  if (isset($_SESSION['user_name']) && isset($_POST["title"]) && isset($_POST["txtarea"]) && isset($_POST["state"])) {
    $name = $_SESSION['user_name'];
    $title = htmlspecialchars($_POST["title"]);
    $txtarea = htmlspecialchars($_POST["txtarea"]);
    $state = htmlspecialchars($_POST["state"]);
    $datetime = date('Y-m-d H:i:s');

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if ($conn == false) {
      echo("Connection failed: " . mysqli_connect_error());
    } else {
      $sql = "INSERT INTO `posts`(`author`, `date_publ`, `title`, `text`, `status`) VALUES (\"$name\",\"$datetime\",\"$title\",\"$txtarea\",\"$state\")";
      $result = mysqli_query($conn, $sql);
      if ($result == true) {
          echo("New POST created successfully<br>");
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