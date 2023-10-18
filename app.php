<!DOCTYPE html>
<head>
    <title>BUChat</title>
 
    <style>
        body {
          font-family: Arial, sans-serif;
          background-color: #f4f4f4;
          margin: 0;
          padding: 20px;
        }
        .message {
          background-color: #fff;
          border: 1px solid #ddd;
          border-radius: 5px;
          padding: 10px;
          margin-bottom: 10px;
        }
        .message h3 {
          color: #333;
          margin: 0;
        }
        .message p {
          color: #555;
          margin: 5px 0;
        }

        .navbar {
          background-color: #333;
          overflow: hidden;
        }

        .navbar a {
          float: left;
          display: block;
          color: white;
          text-align: center;
          padding: 14px 16px;
          text-decoration: none;
        }

        .navbar a:hover {
          background-color: #555;
        }
    </style>
</head>

<div class="navbar">
    <a href="/app.php?board=main.html">Main</a>
    <a href="/app.php?board=tech.html">Tech</a>
    <a href="/app.php?board=meme.html">Memes</a>
    <a href="/app.php?board=food.html">Food</a>
    <a href="/app.php?board=misc.html">Miscellaneous</a>
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
