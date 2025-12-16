<?php
// Utility to generate a password hash
// Upload this file to your server, visit it in browser (e.g., yoursite.com/generate_pass.php?pass=NEWPASSWORD)
// Then copy the hash and update your database.

$password = isset($_GET['pass']) ? $_GET['pass'] : 'admin123';
$hash = password_hash($password, PASSWORD_DEFAULT);

echo "<h1>Password Hash Generator</h1>";
echo "<p><strong>Password:</strong> " . htmlspecialchars($password) . "</p>";
echo "<p><strong>Hash:</strong> " . htmlspecialchars($hash) . "</p>";
echo "<hr>";
echo "<p>Copy this hash and run this SQL query in phpMyAdmin:</p>";
echo "<pre>UPDATE users SET password_hash = '$hash' WHERE username = 'admin';</pre>";
?>
