<?php defined("ACCESS") or exit("Access Denied");

// Read .env variables
$kristal_env = file_get_contents("Config/.env");
if ($kristal_env === false)
{
    throw new Exception("Could not read .env file!");
}

$kristal_env = explode("\n", $kristal_env);
$kristal_set_keys = [];

$kristal_boolean_keys = [
    "PRODUCTION_MODE",
    "DISPLAY_HELPER",
    "MAINTENANCE_MODE",
    "ENABLE_DEBUG",
    "ENABLE_DEBUG_LOG",
    "ENABLE_DEBUG_DISPLAY",
    "DEBUG_IGNORE_WARNINGS",
    "DEBUG_IGNORE_NOTICES",
    "DEBUG_IGNORE_DEPRECATED",
    "DEBUG_IGNORE_STRICT",
    "ENABLE_LANGUAGES",
    "DISPLAY_DEFAULT_LANGUAGE_URL",
    "AUTO_COMPILE_SITEMAP",
    "MINIFY_HTML",
    "AUTO_COMPILE_SCSS",
    "PRINT_COMPILE_DATE_CSS",
    "AUTO_COMPILE_JS",
    "PRINT_COMPILE_DATE_JS",
];

$kristal_mandatory_keys = [
    "PRODUCTION_MODE",
    "DISPLAY_HELPER",
    "MAINTENANCE_MODE",
    "MAINTENANCE_PASSWORD",
    "ENABLE_DEBUG",
    "ENABLE_DEBUG_LOG",
    "ENABLE_DEBUG_DISPLAY",
    "DEBUG_IGNORE_WARNINGS",
    "DEBUG_IGNORE_NOTICES",
    "DEBUG_IGNORE_DEPRECATED",
    "DEBUG_IGNORE_STRICT",
    "DEBUG_LOG_PATH",
    "PRIMARY_DATABASE_HOST",
    "PRIMARY_DATABASE_DATABASE_NAME",
    "PRIMARY_DATABASE_USERNAME",
    "PRIMARY_DATABASE_PASSWORD",
    "SECONDARY_DATABASE_HOST",
    "SECONDARY_DATABASE_DATABASE_NAME",
    "SECONDARY_DATABASE_USERNAME",
    "SECONDARY_DATABASE_PASSWORD",
    "ADDITIONAL_DATABASE_HANDLER",
    "ADDITIONAL_DATABASE_HOST",
    "ADDITIONAL_DATABASE_DATABASE_NAME",
    "ADDITIONAL_DATABASE_USERNAME",
    "ADDITIONAL_DATABASE_PASSWORD",
    "MAILER_HOST",
    "MAILER_EMAIL",
    "MAILER_PASSWORD",
    "MAILER_NAME",
    "MAILER_PROTOCOL",
    "MAILER_PORT",
    "SESSION_NAME",
    "SESSION_TIMEOUT",
    "SESSION_AFK_TIMEOUT",
    "COOKIE_NAME",
    "COOKIE_EXPIRE_TIME",
    "TIMEZONE",
    "DATE_FORMAT",
    "TIME_FORMAT",
    "ENABLE_LANGUAGES",
    "DEFAULT_LANGUAGE",
    "DISPLAY_DEFAULT_LANGUAGE_URL",
    "AUTO_COMPILE_SITEMAP",
    "MINIFY_HTML",
    "AUTO_COMPILE_SCSS",
    "COMPILED_CSS_TYPE",
    "DEFAULT_THEME",
    "PRINT_COMPILE_DATE_CSS",
    "AUTO_COMPILE_JS",
    "PRINT_COMPILE_DATE_JS",
];


// Read all the environment variables
foreach ($kristal_env as $kristal_env_variable)
{
    $kristal_env_variable = trim($kristal_env_variable);

    // Ignore empty lines and comments
    if (empty($kristal_env_variable) || substr($kristal_env_variable, 0, 1) === "#") { continue; }

    // Parse values with double or single quotes
    if (preg_match('/^(.+)=(["\'])(.+)\2$/', $kristal_env_variable, $kristal_matches))
    {
        $kristal_env_key = $kristal_matches[1];
        $kristal_env_value = $kristal_matches[3];
    }
    else
    {
        list($kristal_env_key, $kristal_env_value) = explode("=", $kristal_env_variable, 2);
    }

    // Parse boolean values of boolean keys
    if (in_array($kristal_env_key, $kristal_boolean_keys))
    {
        if (!in_array(strtolower($kristal_env_value), ['true', 'false', '1', '0']))
        {
            throw new Exception("Invalid value for $kristal_env_key. Allowed values are 'true', 'false', '1' and '0'.");
        }

        $kristal_env_value = filter_var($kristal_env_value, FILTER_VALIDATE_BOOLEAN);
    }

    // Store the values to PHP env
    if (putenv("$kristal_env_key=$kristal_env_value"))
    {
        $kristal_set_keys[] = $kristal_env_key;
    }
    else
    {
        throw new Exception("Failed to set environment variable $kristal_env_key!");
    }
}


// Check if all mandatory keys are set
foreach ($kristal_mandatory_keys as $kristal_key)
{
    if (!in_array($kristal_key, $kristal_set_keys))
    {
        throw new Exception("Mandatory environment variable $kristal_key is not set, please create this key to the project's .env file!");
    }
}