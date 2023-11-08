<!DOCTYPE html>
<head>
    <title>BUChat</title>
    <link rel="stylesheet" href="static/style.css"/>
</head>

<div class="navbar">
    <a href="/app.php?board=boards/main.html">Main</a>
    <a href="/app.php?board=boards/tech.html">Tech</a>
    <a href="/app.php?board=boards/meme.html">Memes</a>
    <a href="/app.php?board=boards/food.html">Food</a>
    <a href="/app.php?board=boards/misc.html">Miscellaneous</a>
    <a href="/app.php?board=create.html">Create a new post!</a>
</div>

<?php

$board = $_GET["board"];
readfile($board);

if (isset($_POST["name"])) {
  $name = $_POST["name"];
  $target = $_POST["target"];
  $content = $_POST["message"];
  $date = date('Y-m-d');

  $newpost = '
    <div class="message">
      <p>By: ' . $name . '</p>
      <p>At: ' . $date . '</p>
      <p>
      <p> '. $content .'</p>
    </div>';
  file_put_contents($target, $newpost, FILE_APPEND);
}

?>
