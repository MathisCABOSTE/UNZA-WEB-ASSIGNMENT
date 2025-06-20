<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Providence</title>
	<link rel="icon" type="image/png" href="./content/icon_provid.png" />
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="style.css">
</head>

<body>

	<div class="titre">
		<img src="./content/logo_provid3.png" height="200" class="logo">
	</div>

	<div class="top-right-login">
    	<a href="login.php" class="btn btn-dark">Connection</a>
	</div>

	<nav class="navbar">
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
			<div class="stabilize">
				<button class="callage">
					<img src="./content/unknown.png" height="75">
				</button>
			</div>
		</div>
	</nav>


</body>

</html>