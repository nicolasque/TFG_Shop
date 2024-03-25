<?php
// Erase cookies by setting their expiration time to the past
setcookie('user_id', '', time() - 3600, '/');
setcookie('username', '', time() - 3600, '/');
setcookie('name', '', time() - 3600, '/');
setcookie('surname', '', time() - 3600, '/');
setcookie('email', '', time() - 3600, '/');
setcookie('admin', '', time() - 3600, '/');

// Redirect to another page after erasing cookies
header('Location: ../index.php');
exit;
?>