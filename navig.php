<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="navigstyle.css">
    <title>Providence</title>
    <link rel="icon" type="image/png" href="icon_provid.png" />
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

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
            <div class="goback">
                <form method="POST" class="formgoback" action="index.php">
                    <button class="gobacklogo">
                        <img src="logo_provid3.png" height="75">
                    </button>
                </form>
            </div>
            <div class="search">
                <form method="GET" class="form-inline" action="navig.php">
                    <div class="providdiv">
                        <button class="provid">
                            <img src="providball.gif" height="200">
                        </button>
                    </div>
                    <div class="sbar">
                        <input class="form-control mr-sm-2" type="search" id="si" required="required" placeholder="Ask Provid to provide you" name="si" aria-label="Search">
                    </div>
                </form>
            </div>
        </nav>
    </div>

    <div class="lessites">
        <p class="para" id="para"></p>
    </div>
</body>

</html>