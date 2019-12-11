<?php

?>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css" media="screen" type="text/css" />
    <title>Blog - 4yTrophy</title>
</head>
<body>
<h1>Blog</h1>
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