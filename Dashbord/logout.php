<?php
session_start();
unset($_SESSION['FID']);
session_destroy();

header('Location: ' . '../newloginbs.php');

?>
