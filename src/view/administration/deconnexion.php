<?php
session_start();
if (!isset($_SESSION['administrateur'])) header('Location:../pageIntrouvable.php');
session_destroy();
sleep(2);
header('location:../../../index.php');
?>