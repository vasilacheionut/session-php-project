<?php
session_start();
setcookie('remember_me', '', time() - 3600, "/");
session_destroy();
header('Location: login.php');

require_once "print_session.php";