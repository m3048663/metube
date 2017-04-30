<?php
session_start();
unset($_SESSION['user_name']);
unset($_SESSION['user_id']);
session_unset();
session_destroy();
session_write_close();
session_regenerate_id(true);
header("location: index.php");
exit();
?>
