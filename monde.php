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
                <h1 class="category_h1">MONDE</h1>
                <div class="grid-news">
                    <?php
                        $servername = "localhost";
                        $user = "root";
                        $pass = "";
                        $db = "projekt";
                    
                        $dbc = mysqli_connect($servername, $user, $pass, $db) or die("Error" . mysqli_connect_error());
                    
                        if ($dbc) {
                            $query = "SELECT * FROM articles WHERE category LIKE 'monde' ORDER BY id desc;";
                            $result = mysqli_query($dbc, $query) or die("Error");

                            if ($result) {
                                while ($row = mysqli_fetch_array($result)) 
                                {
                                    echo "<a href=\"article_proccess.php?id=".$row["id"]."\" class=\"article_link\">";
                                    echo "<article class=\"news-item2\">";
                                    echo "<img src=" . $row["photo"] . ">";
                                    echo "<h2>" . $row["title"] . "</h2>";
                                    echo "<h4>" . $row["about"] . "</h4>";
                                    echo "</article>";
                                    echo "</a>";
                                }
                            }
                        }
                        mysqli_close($dbc);


                        function display($id){
                            echo $id;
                        }
                    ?>
                </div>
                <script>
                </script>
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