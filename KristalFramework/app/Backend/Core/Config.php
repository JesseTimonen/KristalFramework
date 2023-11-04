<?php defined("ACCESS") or exit("Access Denied");

// Framework configurations
define("PRODUCTION_MODE", getenv("PRODUCTION_MODE"));
define("DISPLAY_HELPER", getenv("DISPLAY_HELPER"));


// Maintenance configurations
define("MAINTENANCE_MODE", getenv("MAINTENANCE_MODE"));
define("MAINTENANCE_PASSWORD", getenv("MAINTENANCE_PASSWORD"));


// Error reporting configurations
define("ENABLE_DEBUG", getenv("ENABLE_DEBUG"));
define("ENABLE_DEBUG_LOG", getenv("ENABLE_DEBUG_LOG"));
define("ENABLE_DEBUG_DISPLAY", getenv("ENABLE_DEBUG_DISPLAY"));
define("DEBUG_IGNORE_WARNINGS", getenv("DEBUG_IGNORE_WARNINGS"));
define("DEBUG_IGNORE_NOTICES", getenv("DEBUG_IGNORE_NOTICES"));
define("DEBUG_IGNORE_DEPRECATED", getenv("DEBUG_IGNORE_DEPRECATED"));
define("DEBUG_IGNORE_STRICT", getenv("DEBUG_IGNORE_STRICT"));
define("DEBUG_LOG_PATH", getenv("DEBUG_LOG_PATH"));


// Mail configurations
define("MAILER_HOST", getenv("MAILER_HOST"));
define("MAILER_EMAIL", getenv("MAILER_EMAIL"));
define("MAILER_PASSWORD", getenv("MAILER_PASSWORD"));
define("MAILER_NAME", getenv("MAILER_NAME"));
define("MAILER_PROTOCOL", getenv("MAILER_PROTOCOL"));
define("MAILER_PORT", getenv("MAILER_PORT"));


// Session configurations
define("SESSION_NAME", getenv("SESSION_NAME"));
define("SESSION_TIMEOUT", getenv("SESSION_TIMEOUT"));
define("SESSION_AFK_TIMEOUT", getenv("SESSION_AFK_TIMEOUT"));


// Cookie configurations
define("COOKIE_NAME", getenv("COOKIE_NAME"));
define("COOKIE_EXPIRE_TIME", getenv("COOKIE_EXPIRE_TIME"));


// Time configurations
define("TIMEZONE", getenv("TIMEZONE")); 
date_default_timezone_set(TIMEZONE); 
define("DATE_FORMAT", getenv("DATE_FORMAT"));
define("TIME_FORMAT", getenv("TIME_FORMAT"));


// Language configurations
define("ENABLE_LANGUAGES", getenv("ENABLE_LANGUAGES"));
define("DEFAULT_LANGUAGE", getenv("DEFAULT_LANGUAGE"));
define("DISPLAY_DEFAULT_LANGUAGE_URL", getenv("DISPLAY_DEFAULT_LANGUAGE_URL"));


// SEO configurations
define("AUTO_COMPILE_SITEMAP", getenv("AUTO_COMPILE_SITEMAP"));


// HTML configurations
define("MINIFY_HTML", getenv("MINIFY_HTML"));


// SCSS configurations (does not work when in production mode)
define("AUTO_COMPILE_SCSS", getenv("AUTO_COMPILE_SCSS"));
define("COMPILED_CSS_TYPE", getenv("COMPILED_CSS_TYPE"));
define("DEFAULT_THEME", getenv("DEFAULT_THEME"));
define("PRINT_COMPILE_DATE_CSS", getenv("PRINT_COMPILE_DATE_CSS"));


// JavaScript configurations (does not work when in production mode)
define("AUTO_COMPILE_JS", getenv("AUTO_COMPILE_JS"));
define("PRINT_COMPILE_DATE_JS", getenv("PRINT_COMPILE_DATE_JS"));
$js_bundles = (file_exists("App/Public/Javascript/compiler_config.php")) ? include_once "App/Public/Javascript/compiler_config.php" : array();
define("JS_BUNDLES", serialize($js_bundles));


// Page metadata configurations
$metadata = (file_exists("Config/metadata.php")) ? include_once "Config/metadata.php" : array();
define("METADATA", serialize($metadata));


// Database configurations
$databases = array(
    "primary" => (object) array(
        "host" => getenv("PRIMARY_DATABASE_HOST"),
        "database_name" => getenv("PRIMARY_DATABASE_DATABASE_NAME"),
        "username" => getenv("PRIMARY_DATABASE_USERNAME"),
        "password" => getenv("PRIMARY_DATABASE_PASSWORD")
    ),
    "secondary" => (object) array(
        "host" => getenv("SECONDARY_DATABASE_HOST"),
        "database_name" => getenv("SECONDARY_DATABASE_DATABASE_NAME"),
        "username" => getenv("SECONDARY_DATABASE_USERNAME"),
        "password" => getenv("SECONDARY_DATABASE_PASSWORD")
    ),
    getenv("ADDITIONAL_DATABASE_HANDLER") => (object) array(
        "host" => getenv("ADDITIONAL_DATABASE_HOST"),
        "database_name" => getenv("ADDITIONAL_DATABASE_DATABASE_NAME"),
        "username" => getenv("ADDITIONAL_DATABASE_USERNAME"),
        "password" => getenv("ADDITIONAL_DATABASE_PASSWORD")
    ),
);
define("DATABASES", serialize($databases));


// Base URL of your website
define("BASE_URL", ((!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] !== "off") ? "https://" : "http://") . $_SERVER["HTTP_HOST"] . str_replace("index.php", "", $_SERVER["PHP_SELF"]));