<?php

?>
<html>
<head>
    <meta charset="utf-8">
    <!-- importer le fichier de style -->
    <link rel="stylesheet" href="style.css" media="screen" type="text/css" />
</head>
<body>
<h1>Administration</h1>
<div id="content">

    <a href='administration.php?deconnexion=true'><span>Déconnexion</span></a>

    <!-- tester si l'utilisateur est connecté -->
    <?php
    session_start();
    if($_SESSION['username'] == "")
    {
        header('Location: index.html');
    }
    if(isset($_GET['deconnexion']))
    {
        if($_GET['deconnexion'] == true)
        {
            session_unset();
            header('Location: index.html');
        }
    }
    else if($_SESSION['username'] !== ""){
        $user = $_SESSION['username'];
        // afficher un message
        echo "<br>Bonjour $user, vous êtes connectés";
    }
    ?>
</div>
<div>
    <h2>Articles</h2>
    <?php
    $server = "localhost";
    $db_user = 'article4y';
    $db_passwd = '4yarticle';
    $db_name = '4ytrophy';

    $conn = new mysqli($server, $db_user, $db_passwd, $db_name);
    if($conn->connect_error)
    {
        die(sprintf("Connection failed: %s", $conn->connect_error));
    }

    $sql = "SELECT titre, contenu, image_lien FROM articles;";
    $result = $conn->query($sql);

    if($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc())
        {
            echo sprintf("<img src='%s'/>", $row["image_lien"]);
            echo sprintf("<h3>%s</h3>", $row["titre"]);
            echo sprintf("<p>%s</p>", $row["contenu"]);
        }
        echo "</table>";
    }
    else
    {
        echo "0 results";
    }
    $conn->close();
    ?>
</div>
</body>
</html>