<!DOCTYPE html>
<head>
    <title>BUChat</title>
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

// Dave bans any use of the heretic word that i shall not pronounce.
// It has been used by witches to cast dark magic and attain immense powers.
function dave_the_moderator($evil) {
    return str_replace( "script", "EVIL WITCH WORD DETECTED", $evil );
}

// database setup
$db = new SQLite3('store/user.db');
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
        $target = $_POST["target"];
        $content = dave_the_moderator($_POST["message"]);
        $date = date('Y-m-d');

        $newpost = '
        <div class="message">
          <p>By: ' . dave_the_moderator($name) . '</p>
          <p>At: ' . $date . '</p>
          <p>
          <p> '. $content .'</p>
        </div>';
        file_put_contents($target, $newpost, FILE_APPEND);
        echo "Post created!";
    } else {
        echo "Bad login!";
    }
}

?>
