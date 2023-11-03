<?php defined("ACCESS") or exit("Access Denied");


// Framework settings
define("PRODUCTION_MODE", false);                       // Optimizes your application, remember to turn off when editing your page to unlock all the features
define("DISPLAY_HELPER", false);                        // Displays a framework helper during maintenance mode
define("MAINTENANCE_MODE", true);                      // Display maintenance page for users while you are working on your website


// Error reporting
define("ENABLE_DEBUG", true);                           // Controls whether debugging features should be activated. (Setting this to false will disable all error debugging features)
define("ENABLE_DEBUG_LOG", true);                       // Determines if debug messages should be logged to a file
define("ENABLE_DEBUG_DISPLAY", true);                   // Indicates if debug messages should be displayed
define("DEBUG_IGNORE_WARNINGS", false);                 // If true, PHP warnings are neither displayed nor logged. (can not be displayed in production mode)
define("DEBUG_IGNORE_NOTICES", false);                  // If true, PHP notices are neither displayed nor logged. (can not be displayed in production mode)
define("DEBUG_IGNORE_DEPRECATED", false);               // If true, PHP deprecated notices are neither displayed nor logged. (can not be displayed in production mode)
define("DEBUG_IGNORE_STRICT", false);                   // If true, PHP strict standards notices are neither displayed nor logged. (can not be displayed in production mode)
define("DEBUG_LOG_PATH", "../debug.log");               // Sets the file path for logging debug messages. (Please keep this outside of html root)


// Minify HTML
define("MINIFY_HTML", true);                            // Compresses HTML into one single line if set to true (can cause issues with <code> tags)


// Compile SCSS (does not work when in production mode)
define("AUTO_COMPILE_SCSS", true);                      // Auto compile scss every time page is reloaded and changes has been made to scss files
define("COMPILED_CSS_TYPE", "compressed");              // Defines how scss if compiled, use: "expanded" or "compressed"
define("DEFAULT_THEME", "dark");                        // Specify default theme to be used if $_SESSION["theme"] doesn't have a value, if you don't use any themes give it value like "main" or "default"
define("PRINT_COMPILE_DATE_CSS", true);                 // Prints comment saying when css file was last compiled


// Compile JavaScript (does not work when in production mode)
define("AUTO_COMPILE_JS", true);                        // Auto compile javascript every time page is reloaded and changes has been made to js files
define("PRINT_COMPILE_DATE_JS", true);                  // Prints comment saying when javascript file was last compiled
$js_bundles = array(                                    // This array tells how to compile javascript, it combines given js files into compiled js file
    "core" => array(
        "Core/form.js",
        "Core/tooltips.js",
        "Core/translator.js",
    ),
    "maintenance" => array(
        "Scripts/maintenance.js",
    ),
    "main" => array(
        "Scripts/main.js",
    ),
);
define("JS_BUNDLES", serialize($js_bundles));


// Metadata (used to display info at page header) (you can add, modify or even delete metadata tags as you wish)
$metadata = array(
    // Metadata for home page
    "home" => (object) array(
        "type" => "website",                            // Type of the website
        "author" => "________",                         // Author name used for search engines
        "publisher" => "________",                      // Publisher name used for search engines
        "url" => '________',                            // URL of you website
        "title" => "________",                          // Page title displayed in the browser tab
        "og:title" => "________",                       // Page title displayed in social media search engines
        "description" => "________",                    // Description which helps search engines determine what the page is about
        "og:description" => "________",                 // Description which helps social media search engines determine what the page is about
        "keywords" => "Key, Words, Here",               // Keywords which helps search engines determine what the page is about
        "robots" => "all",                              // Use "none" to prevent search engines and "all" to let them have access to your website
    ),
    // Metadata from '/theme' page
    "theme" => (object) array(
        "type" => "website",
        "author" => "________",
        "publisher" => "________",
        "url" => '________',
        "title" => "________",
        "og:title" => "________",
        "description" => "________",
        "og:description" => "________",
        "keywords" => "Key, Words, Here",
        "robots" => "all",
    ),
    // Metadata for every other page
    "*" => (object) array(
        "type" => "website",
        "author" => "________",
        "publisher" => "________",
        "url" => '________',
        "title" => "________",
        "og:title" => "________",
        "description" => "________",
        "og:description" => "________",
        "keywords" => "Key, Words, Here",
        "robots" => "all",
    ),
);
define("METADATA", serialize($metadata));





/* ====================================================================== */
/* ====  That's it, rest of the settings are fetched from .env file  ==== */
/* ====================================================================== */

// Maintenance
define("MAINTENANCE_PASSWORD", getenv('MAINTENANCE_PASSWORD'));

// Databases
$databases = array(
    "primary" => (object) array(
        "host" => getenv('PRIMARY_DATABASE_HOST'),
        "database_name" => getenv('PRIMARY_DATABASE_DATABASE_NAME'),
        "username" => getenv('PRIMARY_DATABASE_USERNAME'),
        "password" => getenv('PRIMARY_DATABASE_PASSWORD')
    ),
    "secondary" => (object) array(
        "host" => getenv('SECONDARY_DATABASE_HOST'),
        "database_name" => getenv('SECONDARY_DATABASE_DATABASE_NAME'),
        "username" => getenv('SECONDARY_DATABASE_USERNAME'),
        "password" => getenv('SECONDARY_DATABASE_PASSWORD')
    ),
    "________" => (object) array(
        "host" => getenv('ADDITIONAL_DATABASE_HOST'),
        "database_name" => getenv('ADDITIONAL_DATABASE_DATABASE_NAME'),
        "username" => getenv('ADDITIONAL_DATABASE_USERNAME'),
        "password" => getenv('ADDITIONAL_DATABASE_PASSWORD')
    ),
);
define("DATABASES", serialize($databases));

// Session
define("SESSION_NAME", getenv('SESSION_NAME'));
define("SESSION_TIMEOUT", getenv('SESSION_TIMEOUT'));
define("SESSION_AFK_TIMEOUT", getenv('SESSION_AFK_TIMEOUT'));

// Mailer
define("MAILER_HOST", getenv('MAILER_HOST'));
define("MAILER_EMAIL", getenv('MAILER_EMAIL'));
define("MAILER_PASSWORD", getenv('MAILER_PASSWORD'));
define("MAILER_NAME", getenv('MAILER_NAME'));
define("MAILER_PROTOCOL", getenv('MAILER_PROTOCOL'));
define("MAILER_PORT", getenv('MAILER_PORT'));

// Time
date_default_timezone_set(getenv('TIMEZONE') ?: 'UTC'); 
define("DATE_FORMAT", getenv('DATE_FORMAT') ?: "j.n.Y"); 
define("TIME_FORMAT", getenv('TIME_FORMAT') ?: "H:i:s");

// Translations
define("DEFAULT_LANGUAGE", getenv('DEFAULT_LANGUAGE') ?: "en");

// Base URL and path of your website
define("BASE_URL", ((!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] !== 'off') ? "https://" : "http://") . $_SERVER["HTTP_HOST"] . str_replace("index.php", "", $_SERVER["PHP_SELF"]));
define("BASE_PATH", __DIR__ . "/");