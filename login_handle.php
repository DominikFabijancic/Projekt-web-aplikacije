<?php
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    $servername = "localhost";
    $user = "root";
    $pass = "";
    $db = "projekt";

    $dbc = mysqli_connect($servername, $user, $pass, $db) or die("Error" . mysqli_connect_error());

    if ($dbc) {

            $query = "SELECT username, password, pravo FROM users WHERE username = ?;";
            $stmt = mysqli_stmt_init($dbc);

            if (mysqli_stmt_prepare($stmt, $query)) {
                mysqli_stmt_bind_param($stmt, 's', $username);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                mysqli_stmt_bind_result($stmt, $username, $hash, $pravo);
                mysqli_stmt_fetch($stmt);

                if (password_verify($password, $hash)) {
                    echo "Prijava je uspjela";
                    session_start();
                    $_SESSION["username"] = $username;
                    $_SESSION["pravo"] = $pravo;
                    header('Location: index.php');
                } else {
                    echo "unijeli ste pogrešno korisničko ime ili lozinku.";
                    header('Location: login.html');
                }

                mysqli_stmt_close($stmt);
            }
    }
    mysqli_close($dbc);

?>