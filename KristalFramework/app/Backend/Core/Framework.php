<?php

// Grant access to php files
define("ACCESS", "Granted");
define("CURRENT_VERSION_NUMBER", 1);


// Include cookie settings
if (file_exists("app/Backend/Core/Env.php")){ require_once "app/Backend/Core/Env.php"; }


// Include variables from config file
if (file_exists("config.php")){ require_once "config.php"; }


// Include notification helper to display errors
if (file_exists("app/Backend/Core/Functions/Notifications.php")){ require_once "app/Backend/Core/Functions/Notifications.php"; }


// Try to load composer autoload.php, die if failed
if (file_exists("app/vendor/autoload.php")){ require_once "app/vendor/autoload.php"; }
else { createError(["Composer autoload was not found!", "Should be located at app/vendor/autoload.php<br>Go to app folder and run 'composer install' command"]); }


// Include debug functionality
if (file_exists("app/Backend/Core/Functions/Debug.php")){ require_once "app/Backend/Core/Functions/Debug.php"; }


// Include framework update check
if (CURRENT_VERSION_NUMBER !== VERSION_NUMBER && PRODUCTION_MODE == false)
{
    if (file_exists("app/Backend/Core/Update.php")){ require_once "app/Backend/Core/Update.php"; }
}


// Include translations
if (file_exists("app/Backend/Core/Functions/Translator.php")){ require_once "app/Backend/Core/Functions/Translator.php"; }


// Include Helper functions
if (file_exists("app/Backend/Core/Functions/Helper.php")){ require_once "app/Backend/Core/Functions/Helper.php"; }
if (file_exists("app/Backend/Core/Functions/commonPasswords.php")){ require_once "app/Backend/Core/Functions/commonPasswords.php"; }


// Include cookie settings
if (file_exists("app/Backend/Core/Cookie.php")){ require_once "app/Backend/Core/Cookie.php"; }


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
if (file_exists("app/Backend/Core/Functions/Forms.php")){ require_once "app/Backend/Core/Functions/Forms.php"; }


// Include cron
if (file_exists("cron/cron.php")){ require_once "cron/cron.php"; }


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
        if (!file_exists("app/pages/maintenance/maintenance.php"))
        {
            createError(["Maintenance page is missing!", "Should be located at app/pages/maintenance/maintenance.php"]);
        }

        $metadata = unserialize(METADATA);
        include "app/pages/maintenance/maintenance.php";
        exit;
    }
}