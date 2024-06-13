<?php
    session_start();
    $id = $_SESSION["article"];

    $servername = "localhost";
    $user = "root";
    $pass = "";
    $db = "projekt";

    $dbc = mysqli_connect($servername, $user, $pass, $db) or die("Error" . mysqli_connect_error());

    if ($dbc) {
        $sql = "DELETE FROM articles WHERE id = ?";            
        $stmt = mysqli_stmt_init($dbc);
            
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, 's', $id);
            mysqli_stmt_execute($stmt);
            echo "delete je uspješan";
        }
    }

    header('Location: index.php');
?>