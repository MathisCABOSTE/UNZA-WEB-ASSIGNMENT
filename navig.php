<!DOCTYPE html>
<html lang="en">

<?php
session_start();
?>
<html>

<head>
    <meta charset="utf-8">
    <title>Providence</title>
    <link rel="icon" type="image/png" href="./content/icon_provid.png" />
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="navigstyle.css">

    <script>

        // Récupère le paramètre "si", l'envoie dans research.php et affiche le résultat dans para
        var url = new URL(window.location.href);
        var input = url.searchParams.get("si");
        var urltofetch = "research.php?si=" + input;
        fetch(urltofetch)
            .then(function(response) {
                return response.text();
            })
            .then(function(response) {
                document.getElementById("para").innerHTML = response;
                document.getElementById("si").value = "";
            });
    </script>


</head>

<body>

    <div class="barhaut">
        <nav class="navbar">
            <!-- <div class="goback">
                <form method="POST" class="formgoback" action="index.php">
                    <button class="gobacklogo">
                        <img src="./content/logo_provid3.png" height="75">
                    </button>
                </form>
            </div> -->
            <div class="search">
                <form method="GET" class="form-inline" action="navig.php">
                    <div class="providdiv">
                        <button class="provid">
                            <img src="./content/providball.gif" height="200">
                        </button>
                    </div>
                    <div class="sbar">
                        <input class="form-control mr-sm-2" type="search" id="si" required="required" placeholder="Ask Provid to provide you" name="si" aria-label="Search">
                    </div>
                </form>
            </div>
            <!-- <div class="top-right-home">
    	        <a href="index.php" class="btn btn-dark">Home</a>
	        </div>
            <div class="top-right-login">
    	        <a href="login.php" class="btn btn-dark">Connection</a>
	        </div> -->
            <div class="top-right-buttons">
                <a href="index.php" class="btn btn-dark">Home</a>
                <div>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <a href="profile.php" class="btn btn-dark">Account</a>
                    <?php else: ?>
                        <a href="login.php" class="btn btn-dark">Log In</a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="top-right-buttons">
                <a href="index.php" class="btn btn-dark mb-2">Home</a>
                                
                <?php if (isset($_SESSION['user_id'])): ?>
                    <div class="dropdown">
                        <button class="btn btn-dark dropdown-toggle" type="button" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Account</button>
                        <div class="dropdown-menu dropdown-menu-right custom-dropdown" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="my_articles.php">My Articles</a>
                            <a class="dropdown-item" href="liked_articles.php">Liked Articles</a>
                            <a class="dropdown-item" href="account_settings.php">Settings</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="logout.php">Disconnect</a>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="login.php" class="btn btn-dark">Log In</a>
                <?php endif; ?>
            </div>


        </nav>
    </div>

    <div class="create-article-btn">
        <a href="create_article.php" class="btn btn-primary">Create New Article</a>
    </div>

    <div class="lessites">
        <p class="para" id="para"></p>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</body>

</html>