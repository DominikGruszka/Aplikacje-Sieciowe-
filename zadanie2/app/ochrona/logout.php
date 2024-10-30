<?php
require_once dirname(__DIR__, 2) . '/config.php'; 

session_start();
session_unset();
session_destroy();

header("Location: " . _APP_URL); 
exit();