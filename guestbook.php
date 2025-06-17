<?php include 'config.php'; ?>
<?php
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}

$confirmation = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars(trim($_POST['name']));
    $message = htmlspecialchars(trim($_POST['message']));
    $stmt = $pdo->prepare("INSERT INTO messages (user, name, message) VALUES (?, ?, ?)");
    $stmt->execute([$_SESSION['user'], $name, $message]);
    $confirmation = "Your message has been submitted!";
}

// Fetch user's messages
$stmt = $pdo->prepare("SELECT * FROM messages WHERE user = ? ORDER BY created_at DESC");
$stmt->execute([$_SESSION['user']]);
$messages = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Guestbook</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="d-flex justify-content-between mb-4">
            <h3>Welcome, <?= htmlspecialchars($_SESSION['user']) ?></h3>
            <a href="logout.php" class="btn btn-outline-danger">Logout</a>
        </div>

        <?php if ($confirmation): ?>
            <div class="alert alert-success"><?= $confirmation ?></div>
        <?php endif; ?>

        <div class="card mb-4 shadow">
            <div class="card-body">
                <form method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Your Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea name="message" class="form-control" rows="3" required></textarea>
                    </div>
                    <button class="btn btn-primary">Submit Message</button>
                </form>
            </div>
        </div>

        <h5>Your Messages</h5>
        <?php foreach ($messages as $msg): ?>
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <h6 class="card-title"><?= htmlspecialchars($msg['name']) ?></h6>
                    <p class="card-text"><?= nl2br(htmlspecialchars($msg['message'])) ?></p>
                    <small class="text-muted"><?= $msg['created_at'] ?></small>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
