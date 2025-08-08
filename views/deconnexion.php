<?php
require_once "../models/Users.php";

session_start();
session_destroy();
header('location: ../views/connexion.php');
exit();

?>