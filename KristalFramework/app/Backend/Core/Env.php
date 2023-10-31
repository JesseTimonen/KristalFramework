<?php

// Read .env variables
$kristal_env = file_get_contents('.env');
if ($kristal_env === false)
{
    throw new Exception('Could not read .env file!');
}

$kristal_env = explode("\n", $kristal_env);
$kristal_set_keys = [];
$kristal_mandatory_keys = [
    'MAINTENANCE_PASSWORD',
    'PRIMARY_DATABASE_HOST',
    'PRIMARY_DATABASE_DATABASE_NAME',
    'PRIMARY_DATABASE_USERNAME',
    'PRIMARY_DATABASE_PASSWORD',
    'SECONDARY_DATABASE_HOST',
    'SECONDARY_DATABASE_DATABASE_NAME',
    'SECONDARY_DATABASE_USERNAME',
    'SECONDARY_DATABASE_PASSWORD',
    'ADDITIONAL_DATABASE_HOST',
    'ADDITIONAL_DATABASE_DATABASE_NAME',
    'ADDITIONAL_DATABASE_USERNAME',
    'ADDITIONAL_DATABASE_PASSWORD',
    'SESSION_NAME',
    'SESSION_TIMEOUT',
    'SESSION_AFK_TIMEOUT',
    'MAILER_HOST',
    'MAILER_EMAIL',
    'MAILER_PASSWORD',
    'MAILER_NAME',
    'MAILER_PROTOCOL',
    'MAILER_PORT',
    'COOKIE_NAME',
    'COOKIE_EXPIRE_TIME',
    'TIMEZONE',
    'DATE_FORMAT',
    'TIME_FORMAT',
    'DEFAULT_LANGUAGE',
];

// Read all the environment variables
foreach ($kristal_env as $kristal_env_variable)
{
    $kristal_env_variable = trim($kristal_env_variable);

    // Ignore empty lines and comments
    if (empty($kristal_env_variable) || substr($kristal_env_variable, 0, 1) === '#') { continue; }

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