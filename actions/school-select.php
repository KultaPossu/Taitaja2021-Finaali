<?php
session_start();

$_SESSION["school"] = $_GET["schools"];

echo $_SESSION["school"];

header('Location: ../graphs.php');

?>