<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - Providence</title>
    <link rel="icon" type="image/png" href="./content/icon_provid.png" />
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #050117;
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: Arial, sans-serif;
        }

        .login-box {
            background-color: #050117;
            padding: 40px;
            border-radius: 10px;
            text-align: center;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
        }

        .login-box img {
            max-width: 100%;
            height: auto;
            margin-bottom: 30px;
        }

        .login-box input[type="email"],
        .login-box input[type="password"] {
            background-color: #fff;
            border: none;
            padding: 12px;
            margin-bottom: 20px;
            width: 100%;
            border-radius: 5px;
        }

        .login-box button {
            background-color: #343a40;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 5px;
            font-weight: bold;
        }

        .login-box button:hover {
            background-color: #495057;
        }

        .top-left-home {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 1000;
        }
    </style>
</head>
<body>
    <div class="top-left-home">
        <a href="index.php">
            <img src="./content/providball.gif" height="100" alt="Home">
        </a>
    </div>


    <form class="login-box" action="auth.php" method="POST">
        <img src="./content/logo_provid3.png" alt="Logo Providence">
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Se connecter</button>
    </form>

</body>
</html>
