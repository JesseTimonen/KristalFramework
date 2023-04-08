<?php defined("ACCESS") or exit("Access Denied");


// Framework settings
define("VERSION_NUMBER", 1);                                    // Framework version you are currently using. WARNING: Changing this variable will download and install the requested version next time when the application is opened
define("PRODUCTION_MODE", false);                               // Optimizes your application, remember to turn off when editing your page to unlock all the features
define("MAINTENANCE_MODE", false);                              // Display maintenance page for users while you are working on your website
define("DISPLAY_HELPER", false);                                // Displays a framework helper during maintenance mode
define("MAINTENANCE_PASSWORD", getenv('MAINTENANCE_PASSWORD')); // Password used to sign in during maintenance mode


// MySQL Databases
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
    "xxxxxxxx" => (object) array(
        "host" => getenv('ADDITIONAL_DATABASE_HOST'),
        "database_name" => getenv('ADDITIONAL_DATABASE_DATABASE_NAME'),
        "username" => getenv('ADDITIONAL_DATABASE_USERNAME'),
        "password" => getenv('ADDITIONAL_DATABASE_PASSWORD')
    ),
);
define("DATABASES", serialize($databases));


// Session
define("SESSION_NAME", getenv('SESSION_NAME'));         // Replace this with a randomly generated string (30-50 characters recommended)
define("SESSION_TIMEOUT", 18000);                       // Session expires after x seconds
define("SESSION_AFK_TIMEOUT", 3600);                    // Session expires after x seconds if user doesn't perform any actions


// Mailer
define("MAILER_HOST", getenv('MAILER_HOST'));           // Host of the email service
define("MAILER_EMAIL", getenv('MAILER_EMAIL'));         // Address of the email account
define("MAILER_PASSWORD", getenv('MAILER_PASSWORD'));   // Password to the email account
define("MAILER_NAME", getenv('MAILER_NAME'));           // Display name in emails
define("MAILER_PROTOCOL", "");                          // Common protocols: ssl, leave empty ("") if your email service doesn't use any protection
define("MAILER_PORT", 465);                             // Common ports: 25, 465, 587 and 2525


// Minify HTML
define("MINIFY_HTML", true);                            // Compresses HTML into one single line if set to true (can cause issues with <code> tags)


// Compile SCSS (does not work when in production mode)
define("AUTO_COMPILE_SCSS", true);                      // Auto compile scss every time page is reloaded and changes has been made to scss files
define("COMPILED_CSS_TYPE", "compressed");              // Defines how scss if compressed, use: "compressed", "compact", "expanded", or "nested"
define("DEFAULT_THEME", "light");                       // Specify default theme to be used if $_SESSION["theme"] doesn't have a value, if you don't use any themes give it value like "main" or "default"
define("PRINT_COMPILE_DATE_CSS", true);                 // Prints comment saying when css file was last compiled


// Compile JavaScript (does not work when in production mode)
define("AUTO_COMPILE_JS", true);                        // Auto compile javascript every time page is reloaded and changes has been made to js files
define("PRINT_COMPILE_DATE_JS", true);                  // Prints comment saying when javascript file was last compiled
$js_bundles = array(                                    // This array tells how to compile javascript, it combines given js files into compiled js file
    "core" => array(
        "core/scrolling.js",
        "core/translator.js",
        "core/tooltip.js",
        "core/form.js",
    ),
    "main" => array(
        "scripts/main.js",
    )
);
define("JS_BUNDLES", serialize($js_bundles));


// Timezone
date_default_timezone_set("UTC");                       // List of all available timezones: https://www.php.net/manual/en/timezones.php


// Date Formats
define("DATE_FORMAT", "j.n.Y");                         // Format which is used to display dates (31.1.2020 => "j.n.Y" | 01/31/2020 => "m/d/Y" | January 31, 2020 => "F j, Y")
define("TIME_FORMAT", "H:i:s");                         // Format which is used to display dates (18:50:04 => "H:i:s" | 06:50 pm => "g:i a" | 06:50:04 pm => "g:i:s a")


// Translations
define("DEFAULT_LANGUAGE", "en");                       // Default language which translators should use if none is specified


// Base URL and path of your website (DO NOT MODIFY UNLESS REQUIRED)
define("BASE_URL", ((!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] !== 'off') ? "https://" : "http://") . $_SERVER["HTTP_HOST"] . str_replace("index.php", "", $_SERVER["PHP_SELF"]));
define("BASE_PATH", __DIR__ . "/");


// Metadata (used to display info at page header) (you can add, modify or even delete metadata tags as you wish)
$metadata = array(
    // Metadata for home page
    "home" => (object) array(
        "type" => "website",                            // Type of the website
        "author" => "xxxxxxxx",                         // Author name used for search engines
        "publisher" => "xxxxxxxx",                      // Publisher name used for search engines
        "url" => BASE_URL,                              // URL of you website
        "title" => "xxxxxxxx",                          // Page title displayed in the browser tab
        "og:title" => "xxxxxxxx",                       // Page title displayed in social media search engines
        "description" => "xxxxxxxx",                    // Description which helps search engines determine what the page is about
        "og:description" => "xxxxxxxx",                 // Description which helps social media search engines determine what the page is about
        "keywords" => "Key, Words, Here",               // Keywords which helps search engines determine what the page is about
        "robots" => "all",                              // Use "none" to prevent search engines and "all" to let them have access to your website
    ),
    // Metadata from '/about' page
    "about" => (object) array(
        "type" => "website",
        "author" => "xxxxxxxx",
        "publisher" => "xxxxxxxx",
        "url" => BASE_URL . "/about",
        "title" => "xxxxxxxx",
        "og:title" => "xxxxxxxx",
        "description" => "xxxxxxxx",
        "og:description" => "xxxxxxxx",
        "keywords" => "Key, Words, Here",
        "robots" => "all",
    ),
    // Metadata from '/theme' page
    "theme" => (object) array(
        "type" => "website",
        "author" => "xxxxxxxx",
        "publisher" => "xxxxxxxx",
        "url" => BASE_URL . "/theme",
        "title" => "xxxxxxxx",
        "og:title" => "xxxxxxxx",
        "description" => "xxxxxxxx",
        "og:description" => "xxxxxxxx",
        "keywords" => "Key, Words, Here",
        "robots" => "all",
    ),
    // Metadata from '/mail' page
    "mail" => (object) array(
        "type" => "website",
        "author" => "xxxxxxxx",
        "publisher" => "xxxxxxxx",
        "url" => BASE_URL . "/mail",
        "title" => "xxxxxxxx",
        "og:title" => "xxxxxxxx",
        "description" => "xxxxxxxx",
        "og:description" => "xxxxxxxx",
        "keywords" => "Key, Words, Here",
        "robots" => "all",
    ),
    // Metadata for every other page
    "*" => (object) array(
        "type" => "website",
        "author" => "xxxxxxxx",
        "publisher" => "xxxxxxxx",
        "url" => BASE_URL,
        "title" => "xxxxxxxx",
        "og:title" => "xxxxxxxx",
        "description" => "xxxxxxxx",
        "og:description" => "xxxxxxxx",
        "keywords" => "Key, Words, Here",
        "robots" => "all",
    ),
);
define("METADATA", serialize($metadata));