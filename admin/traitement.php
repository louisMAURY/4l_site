<?php
session_start();
if(isset($_POST['username']) && isset($_POST['password']))
{
    $db_user = '4ydbchecker';
    $db_password = 'y4y2agymu';
    $db_name = 'lmaury_4yadministration';
    $db_host = 'localhost';
    $db_conn = mysqli_connect($db_host, $db_user, $db_password, $db_name) or die('Impossible de se connecter à la base de données.');
    $username = mysqli_real_escape_string($db_conn, htmlspecialchars($_POST['username']));
    $password = mysqli_real_escape_string($db_conn, htmlspecialchars($_POST['password']));
    $cote = "'";

    if($username !== "" && $password !== "")
    {
        $request = sprintf("SELECT count(*) FROM users WHERE user_name = '%s' AND user_password = '%s';", $username, hash('sha256', $password));
        $exec_request = mysqli_query($db_conn, $request);
        $answer = mysqli_fetch_array($exec_request);
        $count = $answer['count(*)'];
        if($count != 0)
        {
            $_SESSION['username'] = $username;
            header('Location: administration.php');

        }
        else
        {
            header('Location: index.html');
        }
    }
    else
    {
        header('Location: index.html');
    }
}
else
{
    header('Location: index.html');
}
mysqli_close($db_conn);
?>