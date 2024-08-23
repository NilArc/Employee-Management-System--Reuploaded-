<?php
require_once ('process/serverHandler.php');
session_unset();
session_destroy();
header("location:index.html");
?>