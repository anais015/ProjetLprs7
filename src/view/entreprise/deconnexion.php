<?php

session_start();
unset($_SESSION['email']);
unset($_SESSION['mot_de_passe']);
session_destroy();
header('Location: ../../../index.php');

?>