<?php
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashPassword = password_hash($password, CRYPT_BLOWFISH);

    $servername = "localhost";
    $user = "root";
    $pass = "";
    $db = "projekt";

    $dbc = mysqli_connect($servername, $user, $pass, $db) or die("Error" . mysqli_connect_error());

        if ($dbc) {
           
            $query = "SELECT username FROM users WHERE username = ?;";
            $stmt = mysqli_stmt_init($dbc);

            if (mysqli_stmt_prepare($stmt, $query)) {
                mysqli_stmt_bind_param($stmt, 's', $username);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                mysqli_stmt_bind_result($stmt, $username2);
                mysqli_stmt_fetch($stmt);

            }
            mysqli_stmt_close($stmt);
        }
    mysqli_close($dbc);

    if($username2 === null){
        $dbc = mysqli_connect($servername, $user, $pass, $db) or die("Error" . mysqli_connect_error());

        if ($dbc) {
            $query2 = "INSERT INTO users (username, password, pravo) VALUES (?,?,?);";
            $stmt2 = mysqli_stmt_init($dbc);
            if($username === 'admin'){
                $pravo = 1;
            }
            else{
                $pravo = 0;
            }
            if (mysqli_stmt_prepare($stmt2, $query2)) {
                mysqli_stmt_bind_param($stmt2, 'ssi', $username, $hashPassword, $pravo);
                mysqli_stmt_execute($stmt2);
            }
            mysqli_stmt_close($stmt2);
        }
        mysqli_close($dbc);
        header('Location: login.html');
    }else{
        echo "Username vec postoji";
        header('Location: register.html');
    }
?>