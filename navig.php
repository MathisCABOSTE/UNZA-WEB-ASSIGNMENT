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
			<a href="profile.php" class="btn btn-dark">@<?php echo htmlspecialchars($_SESSION['user_id']); ?></a>
		<?php else: ?>
			<a href="login.php" class="btn btn-dark">Log In</a>
		<?php endif; ?>
        </div>
            </div>

        </nav>
    </div>

    <div class="lessites">
        <p class="para" id="para"></p>
    </div>

    
    <!-- <footer class="text-center p-3 mt-4" style="background-color: #050117; color: #ffffff; font-family: 'Courier New', Courier, monospace;">
        <p>&copy; 2025 Providence. All rights reserved.</p>
    </footer> -->
</body>

</html>