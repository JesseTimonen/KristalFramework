<?php

// Grant access to php files
define("ACCESS", "Granted");


// Include cookie settings
if (file_exists("App/Backend/Core/Env.php")){ require_once "App/Backend/Core/Env.php"; }


// Include variables from config file
if (file_exists("config.php")){ require_once "config.php"; }


// Include debug functionality
if (file_exists("App/Backend/Core/Functions/Debug.php")){ require_once "App/Backend/Core/Functions/Debug.php"; }


// Try to load composer autoload.php, die if failed
if (file_exists("App/Backend/Core/vendor/autoload.php")){ require_once "App/Backend/Core/vendor/autoload.php"; }
else { throw new Exception("Composer autoload was not found! Should be located at App/Backend/Core/vendor/autoload.php<br>Go to App/Backend/Core/ folder and run 'composer install' command"); }


// Include translations
if (file_exists("App/Backend/Core/Functions/Translator.php")){ require_once "App/Backend/Core/Functions/Translator.php"; }


// Include Helper functions
if (file_exists("App/Backend/Core/Functions/Helper.php")){ require_once "App/Backend/Core/Functions/Helper.php"; }
if (file_exists("App/Backend/Core/Functions/CommonPasswords.php")){ require_once "App/Backend/Core/Functions/CommonPasswords.php"; }


// Include cookie settings
if (file_exists("App/Backend/Core/Cookie.php")){ require_once "App/Backend/Core/Cookie.php"; }


// Start session
use Backend\Core\Session;
new Session();


// Compile SCSS and JavaScript
use Backend\Core\SCSS_Compiler;
use Backend\Core\JS_Compiler;

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
if (file_exists("App/Backend/Core/Functions/Forms.php")){ require_once "App/Backend/Core/Functions/Forms.php"; }


// Include cron
if (file_exists("App/Backend/Cron/Cron.php")){ require_once "App/Backend/Cron/Cron.php"; }


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
        
        include "App/Pages/maintenance.php";
        exit;
    }
}