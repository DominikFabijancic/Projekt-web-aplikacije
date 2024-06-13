<?php
    $naslov = $_POST['naslov'];
    $kratko = $_POST['kratki'];
    $sadrzaj = $_POST['sadrzaj'];
    $kategorija = $_POST['categorija'];
    $link = $_POST['slika'];

    $servername = "localhost";
    $user = "root";
    $pass = "";
    $db = "projekt";

    $dbc = mysqli_connect($servername, $user, $pass, $db) or die("Error" . mysqli_connect_error());

    if ($dbc) {
        $sql = "INSERT INTO articles (title, about, content, photo, category) values (?, ?, ?, ?, ?)";            
        $stmt = mysqli_stmt_init($dbc);
            
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, 'sssss', $naslov, $kratko, $sadrzaj, $link, $kategorija);
            mysqli_stmt_execute($stmt);
            echo "Unos je uspješan";
        }
    }

    header('Location: index.php');
?>