<?php
require_once 'helpers/redirect-to-login.php';

unset($_SESSION['user']);
session_destroy();

header("Location: /merosewa/");
