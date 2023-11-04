<?php

// Grant access to php files
define("ACCESS", "Granted");


// Load composer autoload.php
if (!file_exists("vendor/autoload.php")) { throw new Exception("Composer autoload was not found! Should be located at the root of the framework inside vendor folder (vendor/autoload.php). Go to the root folder and run 'composer install --prefer-dist --optimize-autoloader' command, incase it does not fix it run 'composer dump-autoload --optimize' to regenerate autoload.php file."); }
require_once "vendor/autoload.php";


// Load .env variables into the project
if (!file_exists("App/Backend/Core/Functions/env.php")) { throw new Exception("File 'App/Backend/Core/Functions/env.php' does not exist!"); }
require_once "App/Backend/Core/Functions/env.php";


// Create constants of .env variables and handle framework configurations
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
// TODO: can the include be removed?
if (!file_exists("App/Backend/Core/Session.php")) { throw new Exception("File 'App/Backend/Core/Session.php' does not exist!"); }
require_once "App/Backend/Core/Session.php";
class_alias("Backend\Core\Session", "Session");
Session::initialize();


// Include cross-site request forgery protection
// TODO: can the include be removed?
if (!file_exists("App/Backend/Core/CSRF.php")) { throw new Exception("File 'App/Backend/Core/CSRF.php' does not exist!"); }
require_once "App/Backend/Core/CSRF.php";
class_alias("Backend\Core\CSRF", "CSRF");
CSRF::initialize();


if (!file_exists("App/Backend/Core/Functions/csrf.php")) { throw new Exception("File 'App/Backend/Core/Functions/csrf.php' does not exist!"); }
require_once "App/Backend/Core/Functions/csrf.php";


// Include translations
if (!file_exists("App/Backend/Core/Functions/translator.php")) { throw new Exception("File 'App/Backend/Core/Functions/translator.php' does not exist!"); }
require_once "App/Backend/Core/Functions/translator.php";


// Include cron jobs
if (!file_exists("App/Backend/Cron/cron.php")) { throw new Exception("File 'App/Backend/Cron/cron.php' does not exist!"); }
require_once "App/Backend/Cron/cron.php";


// Compile SCSS and JavaScript
if (!PRODUCTION_MODE)
{
    // Compile SCSS
    if (AUTO_COMPILE_SCSS)
    {
        Backend\Core\SCSS_Compiler::compile();
    }

    // Compile JavaScript
    if (AUTO_COMPILE_JS)
    {
        Backend\Core\JS_Compiler::compile();
    }
}


if (MAINTENANCE_MODE && !Session::has("maintenance_access_granted"))
{
    // Variables sent to template to tell authentication was failed
    $kristal_authentication_failed = false;
    $kristal_authentication_attempt_limit_reached = false;
    $kristal_authentication_lockout_duration = 0;

    // Check did we get authentication request
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["maintenance-password"]))
    {
        $kristal_rate_limit_file = "App/Public/Cache/Maintenance/lockout-" . Session::get("visitor_identity") . ".php";
        $kristal_failed_attempts = file_exists($kristal_rate_limit_file) ? (time() - filemtime($kristal_rate_limit_file) < MAINTENANCE_LOCKOUT_CLEAR_TIME ? include $kristal_rate_limit_file : 1) : 1;

        if ($kristal_failed_attempts > MAINTENANCE_LOCKOUT_LIMIT)
        {
            // Too many attempts
            $kristal_authentication_attempt_limit_reached = true;
            $kristal_time_difference = MAINTENANCE_LOCKOUT_CLEAR_TIME - (time() - filemtime($kristal_rate_limit_file));
            $kristal_authentication_lockout_duration = $kristal_time_difference > 60 ? floor($kristal_time_difference / 60) . ' min' : $kristal_time_difference . ' s';
        }
        elseif (hash('sha256', $_POST["maintenance-password"]) === MAINTENANCE_PASSWORD)
        {
            // Successful authentication
            Session::add("maintenance_access_granted", "Granted");
        }
        else
        {
            // Failed authentication
            $kristal_authentication_failed = true;
            $kristal_failed_attempts++;
            $kristal_lockout_content = "<?php return $kristal_failed_attempts; ?>";

            if (!file_put_contents($kristal_rate_limit_file, $kristal_lockout_content)) {
                debugLog("Unable to write maintenance authentication lockout data to $kristal_rate_limit_file", "Warning");
            }
        }
    }

    // Show authentication if user did not attempt or failed the authentication
    if (!Session::has("maintenance_access_granted"))
    {
        $maintenancePagePath = "App/Pages/maintenance.php";

        if (!file_exists($maintenancePagePath))
        {
            if (PRODUCTION_MODE)
            {
                exit("Site is under maintenance");
            }
            else
            {
                throw new Exception("Maintenance page is missing! Should be located at {$maintenancePagePath}");
            }
        }

        include $maintenancePagePath;
        Backend\Core\PHPJS::release();
        exit;
    }
}


// Include Routes
if (!file_exists("Routes/routes.php")) { throw new Exception("File 'Routes/routes.php' does not exist!"); }
require_once "Routes/routes.php";


debug($_SESSION);