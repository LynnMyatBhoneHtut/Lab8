<?php
// profile.php
session_start();
require __DIR__ . '/db.php';

if (empty($_SESSION['username'])) {
  header('Location: login.php');
  exit;
}

$username = $_SESSION['username'];

$stmt = $mysqli->prepare("SELECT username, email FROM user WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

if (!$user) { 
  header('Location: logout.php');
  exit;
}

$updated = isset($_GET['updated']) && $_GET['updated'] == '1';
?>
<!doctype html>
<html lang="en">
<head><meta charset="utf-8"><title>Profile</title></head>
<body>
  <p><a href="logout.php">Logout</a></p>
  <h1>Profile</h1>

  <?php if ($updated): ?>
    <p style="color:green;">Your email was updated.</p>
  <?php endif; ?>

  <p><strong>Username:</strong> <?= htmlspecialchars($user['username']) ?></p>
  <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>

  <h3>Edit Profile</h3>
  <form method="post" action="update_profile.php">
    <label>New Email:
      <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
    </label>
    <button type="submit">Save</button>
  </form>
</body>
</html>
