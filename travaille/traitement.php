<?php
if(isset($_POST['submit']))
{
    $to = "imalipusram@4ytrophy.serveblog.net";
    $from = $_POST['email'];
    $name = $_POST['nom'];
    $subject = sprintf("Un message de %s", $name);
    $corporation = $_POST['societe'];
    $message = sprintf("Message de %s (%s)\nEntreprise %s : \n%s", $name, $from, $corporation, $_POST['message']);

    $header = "From: " . $from;
    mail($to, $subject, $message);
    echo "<p> Mail transmis </p>";
    header('Location: contact.html');
}
?>