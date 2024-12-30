<?php
// Include Autoloader 
require_once 'autoloader.php';

// Start Session
session_start();

// INclude the min configuration file
require_once 'config/config.php';

// load database
// require_once 'classes/Database.php';

// Include helper functions
require_once "helpers.php";

//  define global variables
define("APP_NAME", "CMS PDO System");
define("PROJECT_DIR", "cms_pdo");
