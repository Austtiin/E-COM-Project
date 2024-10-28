<?php
//logout.php
//This file will log the user out of the session

session_start();
session_unset();
session_destroy();
header("Location: login.php");
exit();