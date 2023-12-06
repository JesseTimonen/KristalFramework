<?php

// Grant access to php files
define("ACCESS", "Granted");


// Load composer autoload.php
if (!file_exists("vendor/autoload.php")) { throw new Exception("Composer autoload was not found! Should be located at the root of the framework inside vendor folder (vendor/autoload.php). Go to the root folder and run 'composer install --prefer-dist --optimize-autoloader' command, incase it does not fix it run 'composer dump-autoload --optimize' to regenerate autoload.php file."); }
require_once "vendor/autoload.php";


// Load developer's configurations
if (!file_exists("Config/config.php")) { throw new Exception("File 'Config/config.php' does not exist!"); }
require_once "Config/config.php";


// Load framework's configurations
if (!file_exists("App/Backend/Core/Functions/config.php")) { throw new Exception("File 'App/Backend/Core/Functions/config.php' does not exist!"); }
require_once "App/Backend/Core/Functions/config.php";


// Include debug functionality
if (!file_exists("App/Backend/Core/Functions/debug.php")) { throw new Exception("File 'App/Backend/Core/Functions/debug.php' does not exist!"); }
require_once "App/Backend/Core/Functions/debug.php";


// Include utility functions
if (!file_exists("App/Backend/Core/Functions/utilities.php")) { throw new Exception("File 'App/Backend/Core/Functions/utilities.php' does not exist!"); }
require_once "App/Backend/Core/Functions/utilities.php";


// Include cookie settings
if (!file_exists("App/Backend/Core/Functions/cookies.php")) { throw new Exception("File 'App/Backend/Core/Functions/cookies.php' does not exist!"); }
require_once "App/Backend/Core/Functions/cookies.php";


// Initialize session
class_alias("Backend\Core\Session", "Session");
Session::initialize();


// Include cross-site request forgery protection
class_alias("Backend\Core\CSRF", "CSRF");


// Include translations
if (!file_exists("App/Backend/Core/Functions/translator.php")) { throw new Exception("File 'App/Backend/Core/Functions/translator.php' does not exist!"); }
require_once "App/Backend/Core/Functions/translator.php";


// Include cron jobs
if (!file_exists("App/Backend/Cron/cron.php")) { throw new Exception("File 'App/Backend/Cron/cron.php' does not exist!"); }
require_once "App/Backend/Cron/cron.php";


// Initialize Blocks
class_alias("Backend\Core\Block", "Block");
Block::initialize();


// Compile SCSS and JavaScript
if (!PRODUCTION_MODE)
{
    // Compile SCSS
    if (AUTO_COMPILE_SCSS)
    {
        Backend\Core\SCSS_Compiler::initialize();
    }

    // Compile JavaScript
    if (AUTO_COMPILE_JS)
    {
        Backend\Core\JS_Compiler::initialize();
    }
}


// Load routes
if (!file_exists("Routes/routes.php")) { throw new Exception("File 'Routes/routes.php' does not exist!"); }
require_once "Routes/routes.php";