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

    $sql1 = "SELECT titre, contenu, image_lien, article_id FROM articles;";
    $result = $conn->query($sql1);

    if($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc())
        {
            echo sprintf("
                <div class='article'>
                    <form action='update_articles.php' method='POST'>
                        <img class='miniature' src='%s'/>
                        <label>Titre de l'article</label>
                        <input type='text' id='article_id' name='article_id' value='%d' >
                        <input value='%s' name='titre'>
                        <label>Contenu de l'article (limite 2000 caractères)</label>
                        <textarea rows='20' cols='100' maxlength='2000' name='contenu' required>%s</textarea>
                        <input type='submit' id='update' value='Mettre à jour' />
                    </form>
                </div>
            ", $row["image_lien"], $row["article_id"], $row["titre"], $row["contenu"]);
        }
    }
    else
    {
        echo "0 results";
    }
    $conn->close();
    ?>
    <!--
    <form action="traitement.php" method="POST">
        <h1>Connexion</h1>

        <label><b>Nom d'utilisateur</b></label>
        <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>

        <label><b>Mot de passe</b></label>
        <input type="password" placeholder="Entrer le mot de passe" name="password" required>

        <input type="submit" id='submit' value='LOGIN' >
    </form>
    -->
</div>
</body>
</html>

            <?php
/*
<div class='article'>
    <form action='update_articles.php' method='POST'>
        <img class='miniature' src='%s'/>
        <label>Titre de l'article</label>
        <input value='%s' name='titre'>
        <label>Contenu de l'article (limite 2000 caractères)</label>
        <textarea rows='20' cols='100' maxlength='2000' name='contenu' required>%s</textarea>
        <input type='submit' id='update' value='Mettre à jour' />
    </form>
</div>
", $row["image_lien"], $row["titre"], $row["contenu"]);
*/
?>