<?php require_once("admin/includes/init.php"); ?>
<?php require_once("admin/includes/header.php"); ?>

<?php

$session->logout();
redirect("index.php");

?>