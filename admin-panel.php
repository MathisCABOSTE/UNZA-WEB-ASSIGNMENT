<?php
session_start();

// Accès réservé aux administrateurs
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit();
}

$host = 'localhost';
$user = 'providence';
$password = 'bb1wy';
$database = 'Providence';

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Database connection failed.");
}

// Gestion de la recherche
$search = isset($_GET['search']) ? '%' . $conn->real_escape_string($_GET['search']) . '%' : '%';

$stmt = $conn->prepare("SELECT user_id FROM users WHERE user_id LIKE ? ORDER BY user_id ASC");
$stmt->bind_param("s", $search);
$stmt->execute();
$result = $stmt->get_result();

$users = [];
while ($row = $result->fetch_assoc()) {
    $users[] = $row['user_id'];
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Providence</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="genrstyle.css">
    <style>
        body {
            background-color: #06021c;
            color: white;
            min-height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            padding: 30px;
            display: block;
        }

        .box {
            margin: 0 auto;
            background-color: #050117;
            padding: 40px 40px 30px 40px;
            border-radius: 10px;
            text-align: left;
            width: 100%;
            max-width: 850px;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.5);
            color: #fff;
        }

        @media (max-width: 800px) {
            .box {
                padding: 25px 10px;
            }
        }

        .admin-search {
            padding: 30px 40px 10px;
            display: flex;
            justify-content: center;
        }

        .admin-users {
            display: flex;
            flex-direction: column;
            gap: 15px;
            padding: 20px 40px;
        }

        .dropdown-user {
            background-color: #333333;
            border-radius: 8px;
            padding: 12px 16px;
            width: 300px;
            font-size: 1.1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .dropdown-menu {
            background-color: #404040;
            width: 300px;
        }

        .dropdown-item {
            color: white;
        }

        .dropdown-item:hover {
            background-color: #505050;
            color: #66b2ff;
        }

        .top-left-home {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 1000;
        }

        .top-left-home .btn-dark {
            background-color: #09032a;
            border-color: #ccc;
            padding: 8px 16px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="top-left-home">
        <a href="index.php" class="btn btn-dark">Home</a>
    </div>

    <div class="box">
        <div class="admin-search">
            <form method="GET" action="admin-panel.php" class="form-inline w-100" style="max-width: 600px;">
                <input type="text" class="form-control w-100" name="search" placeholder="Search a user..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" />
            </form>
        </div>
        
        <div class="admin-users">
            <?php if (empty($users)): ?>
                <p class="text-center">No user found.</p>
            <?php else: ?>
                <?php foreach ($users as $user): ?>
                    <div class="dropdown">
                        <div class="dropdown-user dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @<?php echo htmlspecialchars($user); ?>
                        </div>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="liked_articles.php?user=<?php echo urlencode($user); ?>">Liked Articles</a>
                            <a class="dropdown-item" href="my_articles.php?user=<?php echo urlencode($user); ?>">Authored Articles</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</body>
</html>
