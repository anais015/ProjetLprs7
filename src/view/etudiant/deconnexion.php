<?php
session_start();
if (!isset($_SESSION['etudiant'])) header('Location:../pageIntrouvable.php');
session_destroy();
sleep(2);
header('location:../../../index.php');
?>