<?php
// update_profile.php
session_start();
require __DIR__ . '/db.php';

if (empty($_SESSION['username'])) {
  header('Location: login.php');
  exit;
}

$newEmail = trim($_POST['email'] ?? '');
if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
  header('Location: profile.php?updated=0');
  exit;
}

$username = $_SESSION['username'];

$stmt = $mysqli->prepare("UPDATE user SET email = ? WHERE username = ?");
$stmt->bind_param("ss", $newEmail, $username);
$stmt->execute();

header('Location: profile.php?updated=1');
exit;
