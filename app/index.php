<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
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

	<div class="top-right-login dropdown">
	    <?php if (isset($_SESSION['user_id'])): ?>
	        <button class="btn btn-dark dropdown-toggle" type="button" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	            Connected as @<?php echo htmlspecialchars($_SESSION['user_id']); ?>
	        </button>
	        <div class="dropdown-menu dropdown-menu-right custom-dropdown" aria-labelledby="userDropdown">
	            <a class="dropdown-item" href="my_articles.php">My Articles</a>
	            <a class="dropdown-item" href="liked_articles.php">Liked Articles</a>
	            <a class="dropdown-item" href="account_settings.php">Settings</a>
	            <div class="dropdown-divider"></div>
	            <a class="dropdown-item text-danger" href="logout.php">Disconnect</a>
	        </div>
	    <?php else: ?>
	        <a href="login.php" class="btn btn-dark">Log In</a>
	    <?php endif; ?>
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

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

</body>
</html>