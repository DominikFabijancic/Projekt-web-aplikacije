<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>L`Express</title>
        <link rel="stylesheet" type="text/css" href="css/index.css">
    </head>
    <body>
        <header>
            <div class="logo">
                <img src="slike/logo.png" class="logo-img">
            </div>
            <nav>
                <div class="seperator">
                    <ol class="nav-list">
                        <li><a href="index.php">HOME</a></li>
                        <li><a href="monde.php">MONDE</a></li>
                        <li><a href="economie.php">ECONOMIE</a></li>
                    </ol>
                    <ol class="nav-list" id="create">
                        <?php
                            session_start();
                            $username = $_SESSION["username"];
                            $pravo = $_SESSION["pravo"];
                            
                            if($pravo === 1){
                                echo "<li><a href=\"form.html\">ADMINISTRACIJA</a></li>";
                            }
                        ?>
                        <li><a href="login.html">LOGOUT</a></li>
                    </ol>
                </div>
            </nav>
        </header>


        <main>
            <div class="main-div">
                <?php
                    $id = $_SESSION["article"];

                    $servername = "localhost";
                    $user = "root";
                    $pass = "";
                    $db = "projekt";
                
                    $dbc = mysqli_connect($servername, $user, $pass, $db) or die("Error" . mysqli_connect_error());
                
                    if ($dbc) {
                        $query = "SELECT * FROM articles WHERE id LIKE $id LIMIT 1;";
                        $result = mysqli_query($dbc, $query) or die("Error");

                        if ($result) {
                            while ($row = mysqli_fetch_array($result)) 
                            {
                                $category = $row["category"];
                                $naslov = $row["title"];
                                $about = $row["about"];
                                $content = $row["content"];
                                $photo = $row["photo"];
                                $date = $row["reg_date"];
                            }
                        }
                    }
                    mysqli_close($dbc);
                ?>
                <div class="article delete">
                    <?php
                        $pravo = $_SESSION["pravo"];
                                
                        if($pravo === 1){
                            echo "<a href=\"delete.php\">DELETE ARTICLE</a>";
                        }
                    ?>
                    <h2 class="article_cat"><?php echo $category; ?></h2>
                    <h1 class="article_naslov"><?php echo $naslov; ?> : <?php echo $about; ?></h1>
                    <p class="article_date"><?php echo $date; ?></p>
                    <img class="article_img" src="<?php echo $photo; ?>" alt="img">
                    <p class="article_text"><?php echo $content; ?></p>
                </div>
            </div>
        </main>
            

        <footer>
            <div class="center-footer">
                <p>Les sites du reseau Groupe L`Express : Food avec Mycuisine.fr</p>
                <br>
                <p>© L'Express </p>
            </div>
        </footer>
    </body>
</html>