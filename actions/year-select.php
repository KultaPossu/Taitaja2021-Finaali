<?php

session_start();

$_SESSION["year"] = $_GET["year"];

echo $_SESSION["year"];

header('Location: ../graphs.php');