<?php defined("ACCESS") or exit("Access Denied");

$kristal_mandatory_constants = [
    "PRODUCTION_MODE",
    "BASE_URL",
    "MAINTENANCE_MODE",
    "MAINTENANCE_PASSWORD",
    "MAINTENANCE_LOCKOUT_LIMIT",
    "MAINTENANCE_LOCKOUT_CLEAR_TIME",
    "ENABLE_DEBUG",
    "ENABLE_DEBUG_LOG",
    "ENABLE_DEBUG_DISPLAY",
    "DEBUG_IGNORE_WARNINGS",
    "DEBUG_IGNORE_NOTICES",
    "DEBUG_IGNORE_DEPRECATED",
    "DEBUG_IGNORE_STRICT",
    "DEBUG_LOG_PATH",
    "DATABASES",
    "MAILER_HOST",
    "MAILER_EMAIL",
    "MAILER_PASSWORD",
    "MAILER_NAME",
    "MAILER_PROTOCOL",
    "MAILER_PORT",
    "SESSION_NAME",
    "SESSION_TIMEOUT",
    "SESSION_AFK_TIMEOUT",
    "REGENERATE_CSRF_ON_PAGE_REFRESH",
    "COOKIE_NAME",
    "COOKIE_EXPIRE_TIME",
    "TIMEZONE",
    "DATE_FORMAT",
    "TIME_FORMAT",
    "ENABLE_LANGUAGES",
    "DEFAULT_LANGUAGE",
    "AVAILABLE_LANGUAGES",
    "AUTO_COMPILE_SITEMAP",
    "MINIFY_HTML",
    "AUTO_COMPILE_SCSS",
    "COMPILED_CSS_TYPE",
    "DEFAULT_THEME",
    "PRINT_COMPILE_DATE_CSS",
    "AUTO_COMPILE_JS",
    "PRINT_COMPILE_DATE_JS",
    "JS_BUNDLES",
    "METADATA",
];

// Make sure constants exist
foreach ($kristal_mandatory_constants as $constant)
{
    if (!defined($constant))
    {
        throw new Exception("Mandatory configuration variable $constant is not set, please create this constant to the project's config.php file!");
    }
}

// Make sure default language is within available languages
if (!in_array(DEFAULT_LANGUAGE, unserialize(AVAILABLE_LANGUAGES)))
{
    throw new Exception("Default language " . DEFAULT_LANGUAGE . " is not within the available languages!");
}

// Set default timezone
date_default_timezone_set(TIMEZONE);
