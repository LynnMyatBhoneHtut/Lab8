<?php
// login.php
session_start();
require __DIR__ . '/db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $u = trim($_POST['username'] ?? '');
  $p = trim($_POST['password'] ?? '');

  $stmt = $mysqli->prepare("SELECT username, password FROM user WHERE username = ?");
  $stmt->bind_param("s", $u);
  $stmt->execute();
  $res = $stmt->get_result();
  if ($row = $res->fetch_assoc()) {
    if ($p === $row['password']) {
      $_SESSION['username'] = $row['username'];
      header('Location: profile.php');
      exit;
    }
  }
  $error = 'Incorrect username or password.';
}
?>
<!doctype html>
<html lang="en">
<head><meta charset="utf-8"><title>Login</title></head>
<body>
  <h1>Login</h1>
  <form method="post" action="login.php">
    <label>Username: <input name="username" required></label><br><br>
    <label>Password: <input type="password" name="password" required></label><br><br>
    <button type="submit">Login</button>
  </form>
  <?php if ($error) echo "<p style='color:red;'>$error</p>"; ?>
</body>
</html>
