<?php

// Grant access to php files
define("ACCESS", "Granted");


// Include cookie settings
if (!file_exists("App/Backend/Core/Env.php")) { throw new Exception("File 'App/Backend/Core/Env.php' does not exist!"); }
require_once "App/Backend/Core/Env.php";


// Include variables from config file
if (!file_exists("App/Backend/Core/Config.php")) { throw new Exception("File 'App/Backend/Core/Config.php' does not exist!"); }
require_once "App/Backend/Core/Config.php";


// Include debug functionality
if (!file_exists("App/Backend/Core/Functions/Debug.php")) { throw new Exception("File 'App/Backend/Core/Functions/Debug.php' does not exist!"); }
require_once "App/Backend/Core/Functions/Debug.php";


// Try to load composer autoload.php, die if failed
if (!file_exists("vendor/autoload.php")) { throw new Exception("Composer autoload was not found! Should be located at the root of the framework inside vendor folder (vendor/autoload.php). Go to the root folder and run 'composer install --prefer-dist --optimize-autoloader' command, incase it does not fix it run 'composer dump-autoload --optimize' to regenerate autoload.php file."); }
require_once "vendor/autoload.php";


// Include translations
if (!file_exists("App/Backend/Core/Functions/Translator.php")) { throw new Exception("File 'App/Backend/Core/Functions/Translator.php' does not exist!"); }
require_once "App/Backend/Core/Functions/Translator.php";


// Include Helper functions
if (!file_exists("App/Backend/Core/Functions/Helper.php")) { throw new Exception("File 'App/Backend/Core/Functions/Helper.php' does not exist!"); }
require_once "App/Backend/Core/Functions/Helper.php";


// Include cookie settings
if (!file_exists("App/Backend/Core/Cookies.php")) { throw new Exception("File 'App/Backend/Core/Cookies.php' does not exist!"); }
require_once "App/Backend/Core/Cookies.php";


// Start session
use Backend\Core\Session;
new Session();


// Compile SCSS and JavaScript
use Backend\Core\SCSS_Compiler;
use Backend\Core\JS_Compiler;
use Backend\Core\PHPJS;


if (!PRODUCTION_MODE)
{
    // Compile SCSS
    if (AUTO_COMPILE_SCSS === true || strtolower(AUTO_COMPILE_SCSS) === "true")
    {
        SCSS_Compiler::compile();
    }

    // Compile JavaScript
    if (AUTO_COMPILE_JS === true || strtolower(AUTO_COMPILE_JS) === "true")
    {
        JS_Compiler::compile();
    }
}


// Include cross-site request forgery protection
if (!file_exists("App/Backend/Core/Functions/Forms.php")) { throw new Exception("File 'App/Backend/Core/Functions/Forms.php' does not exist!"); }
require_once "App/Backend/Core/Functions/Forms.php";


// Include cron
if (!file_exists("App/Backend/Cron/Cron.php")) { throw new Exception("File 'App/Backend/Cron/Cron.php' does not exist!"); }
require_once "App/Backend/Cron/Cron.php";


// Include Routes
if (!file_exists("Routes/routes.php")) { throw new Exception("File 'Routes/routes.php' does not exist!"); }
require_once "Routes/routes.php";


if (MAINTENANCE_MODE === true && !isset($_SESSION["maintenance_access_granted"]))
{
    // Variable to tell authentication was failed
    $kristal_authentication_failed = false;
    
    // Maintenance authentication
    if (isset($_POST["maintenance-password"]))
    {
        if ($_POST["maintenance-password"] === MAINTENANCE_PASSWORD)
        {
            $_SESSION["maintenance_access_granted"] = true;
        }
        else
        {
            // Variable to tell authentication was failed
            $kristal_authentication_failed = true;
        }
    }

    // Display maintenance page if maintenance mode is enabled
    if (!isset($_SESSION["maintenance_access_granted"]))
    {
        if (!file_exists("App/Pages/maintenance.php"))
        {
            throw new Exception("Maintenance page is missing! Should be located at App/Pages/maintenance.php");
        }

        // Render PHP created javascript variables and code
        PHPJS::release();
        
        include "App/Pages/maintenance.php";
        exit;
    }
}