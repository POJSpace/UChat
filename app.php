<!DOCTYPE html>
<head>
    <title>UChat</title>
    <script src="static/login.js"> </script>
    <script src="https://unpkg.com/htmx.org@1.9.8"></script>
    <link rel="stylesheet" href="static/app.css"/>
</head>

<div class="navbar">
    <a href="/app.php?site=main.html">Main</a>
    <a href="/app.php?site=tech.html">Tech</a>
    <a href="/app.php?site=meme.html">Memes</a>
    <a href="/app.php?site=food.html">Food</a>
    <a href="/app.php?site=misc.html">Miscellaneous</a>
    <a href="/app.php?site=create.html">Create a new post!</a>
    <a href="/app.php?site=register.html">Register</a>
    <a href="/app.php?site=login.html">Login</a>
</div>

<?php

$site = $_GET["site"];
if ($site != "create.html" && $site != "register.html" && $site != "login.html") {
    $site = "boards/" . $site;
}

readfile($site);

function sanitize($evil) {
    return str_replace( "script", "EVIL WITCH WORD DETECTED", $evil );
}

function is_image($name) {
    $buf = "";
    $file_ext_start = false;
    foreach (str_split($name) as $char) {
        if ($file_ext_start) {
            $buf .= $char;
            if ($buf == "jpg" || $buf == "png" || $buf == "jpeg") {
                return true;
            }
        } else if ($char == ".") {
            $file_ext_start = true;
        }
    }
    return false;
}

// database setup
$db = new SQLite3('./store/user.db');
$db->exec("CREATE TABLE credentials(id TEXT PRIMARY KEY, password TEXT)");

// user registration
if (isset($_POST["username"])) {
    $username = $_POST["username"];
    $password = $_POST["passcode"];
    $sql = "INSERT INTO credentials VALUES ('" . $username . "', '" . $password . "');";
    $db->exec($sql);
    echo "Succesful registration!";
}

// creation of post
if (isset($_POST["name"])) {
    $name = $_POST["name"];
    $password = $_POST["password"];

    $sql = "SELECT password FROM credentials WHERE id='" . $name . "'"; 
    if ($name != "" && $password == $db->querySingle($sql)) {
        $media = "";
        if (isset($_FILES["media"])) {
            if (is_image($_FILES["media"]["name"])) {
                $path = "upload/" . $_FILES["media"]["name"];
                move_uploaded_file($_FILES["media"]["tmp_name"], $path);
                $media = "<br><br><img src='" . $path . "'/>";               
            } else {
                echo "File is not an image!<br>";
            }
        }
        
        $target = $_POST["target"];
        $content = sanitize($_POST["message"]);
        $date = date('Y-m-d');

        $newpost = '
        <div class="message">
          <p>By: ' . sanitize($name) . '</p>
          <p>At: ' . $date . '</p>
          <p>
          <p> '. $content . $media . '</p>
        </div>';
        file_put_contents($target, $newpost, FILE_APPEND);
        echo "Post created!";
    } else {
        echo "Bad login!";
    }
}

?>
