<?php
session_start();
if(isset($_POST['titre']) && isset($_POST['contenu']) && isset($_POST['article_id']))
{
    $db_user = 'article4y';
    $db_passwd = '4yarticle';
    $db_name = '4ytrophy';
    $server = "localhost";

    $conn = mysqli_connect($server, $db_user, $db_passwd, $db_name) or die('Impossible de se connecter à la base de données.');
    $titre = mysqli_real_escape_string($conn, htmlspecialchars($_POST['titre']));
    $contenu = mysqli_real_escape_string($conn, htmlspecialchars($_POST['contenu']));
    $id = mysqli_real_escape_string($conn, htmlspecialchars($_POST['article_id']));

    if($titre !== "" && $contenu !== "" && $id !== "")
    {
        $request = sprintf("
        UPDATE articles
        SET titre = '%s',
        contenu = '%s'
        WHERE article_id = %d
        ", $titre, $contenu, $id);

        $result = $conn->query($sql);
        $exec_request = mysqli_query($conn, $request);
        $answer = mysqli_fetch_array($exec_request);
        header('Location: administration.php');
    }
    else
    {
        header('Location: administration.php');
    }
}
else
{
    echo 'erreur';
}
mysqli_close($conn);
?>