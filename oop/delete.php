<?php

require_once("db.php");
$pdo_statement = $DBH->prepare("DELETE FROM appointments WHERE id=" . $_GET["id"]);
$pdo_statement->execute();
header("location: index.php");