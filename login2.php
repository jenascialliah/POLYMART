<?php
// Very insecure login handler (FOR EDUCATIONAL USE ONLY)

$username = $_POST['username'];
$password = $_POST['password'];

echo "<h2>Login Received</h2>";
echo "Username: " . htmlspecialchars($username) . "<br>";
echo "Password: " . htmlspecialchars($password) . "<br>";

?>
