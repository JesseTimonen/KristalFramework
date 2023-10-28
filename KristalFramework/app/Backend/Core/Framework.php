<?php

// Grant access to php files
define("ACCESS", "Granted");


// Include cookie settings
if (file_exists("app" . DIRECTORY_SEPARATOR . "Backend" . DIRECTORY_SEPARATOR . "Core" . DIRECTORY_SEPARATOR . "Env.php")){ require_once "app" . DIRECTORY_SEPARATOR . "Backend" . DIRECTORY_SEPARATOR . "Core" . DIRECTORY_SEPARATOR . "Env.php"; }


// Include variables from config file
if (file_exists("config.php")){ require_once "config.php"; }


// Include notification helper to display errors
if (file_exists("app" . DIRECTORY_SEPARATOR . "Backend" . DIRECTORY_SEPARATOR . "Core" . DIRECTORY_SEPARATOR . "Functions" . DIRECTORY_SEPARATOR . "Notifications.php")){ require_once "app" . DIRECTORY_SEPARATOR . "Backend" . DIRECTORY_SEPARATOR . "Core" . DIRECTORY_SEPARATOR . "Functions" . DIRECTORY_SEPARATOR . "Notifications.php"; }


// Try to load composer autoload.php, die if failed
if (file_exists("app" . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php")){ require_once "app" . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php"; }
else { throw new Exception("Composer autoload was not found! Should be located at app" . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php<br>Go to app folder and run 'composer install' command"); }


// Include debug functionality
if (file_exists("app" . DIRECTORY_SEPARATOR . "Backend" . DIRECTORY_SEPARATOR . "Core" . DIRECTORY_SEPARATOR . "Functions" . DIRECTORY_SEPARATOR . "Debug.php")){ require_once "app" . DIRECTORY_SEPARATOR . "Backend" . DIRECTORY_SEPARATOR . "Core" . DIRECTORY_SEPARATOR . "Functions" . DIRECTORY_SEPARATOR . "Debug.php"; }


// Include translations
if (file_exists("app" . DIRECTORY_SEPARATOR . "Backend" . DIRECTORY_SEPARATOR . "Core" . DIRECTORY_SEPARATOR . "Functions" . DIRECTORY_SEPARATOR . "Translator.php")){ require_once "app" . DIRECTORY_SEPARATOR . "Backend" . DIRECTORY_SEPARATOR . "Core" . DIRECTORY_SEPARATOR . "Functions" . DIRECTORY_SEPARATOR . "Translator.php"; }


// Include Helper functions
if (file_exists("app" . DIRECTORY_SEPARATOR . "Backend" . DIRECTORY_SEPARATOR . "Core" . DIRECTORY_SEPARATOR . "Functions" . DIRECTORY_SEPARATOR . "Helper.php")){ require_once "app" . DIRECTORY_SEPARATOR . "Backend" . DIRECTORY_SEPARATOR . "Core" . DIRECTORY_SEPARATOR . "Functions" . DIRECTORY_SEPARATOR . "Helper.php"; }
if (file_exists("app" . DIRECTORY_SEPARATOR . "Backend" . DIRECTORY_SEPARATOR . "Core" . DIRECTORY_SEPARATOR . "Functions" . DIRECTORY_SEPARATOR . "commonPasswords.php")){ require_once "app" . DIRECTORY_SEPARATOR . "Backend" . DIRECTORY_SEPARATOR . "Core" . DIRECTORY_SEPARATOR . "Functions" . DIRECTORY_SEPARATOR . "commonPasswords.php"; }


// Include cookie settings
if (file_exists("app" . DIRECTORY_SEPARATOR . "Backend" . DIRECTORY_SEPARATOR . "Core" . DIRECTORY_SEPARATOR . "Cookie.php")){ require_once "app" . DIRECTORY_SEPARATOR . "Backend" . DIRECTORY_SEPARATOR . "Core" . DIRECTORY_SEPARATOR . "Cookie.php"; }


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
if (file_exists("app" . DIRECTORY_SEPARATOR . "Backend" . DIRECTORY_SEPARATOR . "Core" . DIRECTORY_SEPARATOR . "Functions" . DIRECTORY_SEPARATOR . "Forms.php")){ require_once "app" . DIRECTORY_SEPARATOR . "Backend" . DIRECTORY_SEPARATOR . "Core" . DIRECTORY_SEPARATOR . "Functions" . DIRECTORY_SEPARATOR . "Forms.php"; }


// Include cron
if (file_exists("cron" . DIRECTORY_SEPARATOR . "cron.php")){ require_once "cron" . DIRECTORY_SEPARATOR . "cron.php"; }


if (MAINTENANCE_MODE === true && !isset($_SESSION["maintenance_access_granted"]))
{
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
            $authentication_failed = true;
        }
    }

    // Display maintenance page if maintenance mode is enabled
    if (!isset($_SESSION["maintenance_access_granted"]))
    {
        if (!file_exists("app" . DIRECTORY_SEPARATOR . "pages" . DIRECTORY_SEPARATOR . "maintenance.php"))
        {
            throw new Exception("Maintenance page is missing! Should be located at app" . DIRECTORY_SEPARATOR . "pages" . DIRECTORY_SEPARATOR . "maintenance.php");
        }
        
        include "app" . DIRECTORY_SEPARATOR . "pages" . DIRECTORY_SEPARATOR . "maintenance.php";
        exit;
    }
}