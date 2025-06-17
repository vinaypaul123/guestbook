<?php include 'config.php'; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['user'] = htmlspecialchars(trim($_POST['username']));
    header("Location: guestbook.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Guestbook</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="d-flex align-items-center justify-content-center vh-100 bg-light">
    <div class="card shadow p-4" style="width: 24rem;">
        <h4 class="mb-3 text-center">Login to Guestbook</h4>
        <form method="post">
            <div class="mb-3">
                <input type="text" name="username" class="form-control" placeholder="Enter your username" required>
            </div>
            <button class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</body>
</html>
