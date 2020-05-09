<?php
session_start();
session_unset();
if(session_destroy())
{
// Redirecting To Home Page
header("Location: login.php");
}
?>
