<?php
    session_start();
    $id = $_GET['id'];
    $_SESSION["article"] = $id;


    header('Location: article.php');
?>