<?php
session_start();
session_destroy();
unset($_session['name']);
header("location: index.php");
?>