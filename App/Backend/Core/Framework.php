<?php


// Grant access to php files
define("ACCESS", "Granted");


// Load composer autoload.php
if (!file_exists("vendor/autoload.php")) {
    exit("The Composer autoload file was not found! It should be located in the vendor folder at the root of the framework (vendor/autoload.php).<br>Go to the root folder and run the command 'composer install --prefer-dist --optimize-autoloader'. If this does not fix the issue, run 'composer dump-autoload --optimize' to regenerate the autoload.php file.");
}


// Load core files
require_once "vendor/autoload.php";
require_once "Config/config.php";
require_once "App/Backend/Core/Functions/config.php";
require_once "App/Backend/Core/Functions/debug.php";
require_once "App/Backend/Core/Functions/utilities.php";
require_once "App/Backend/Core/Functions/cookies.php";
require_once "App/Backend/Core/Functions/translator.php";
require_once "App/Backend/Cron/cron.php";


// Initialize session
class_alias("Backend\Core\Session", "Session");
Session::initialize();


// Include cross-site request forgery protection
class_alias("Backend\Core\CSRF", "CSRF");


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
require_once "Routes/routes.php";
