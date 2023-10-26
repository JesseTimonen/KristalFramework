<?php

// Read .env variables
$env = file_get_contents('.env');
if ($env === false) {
    throw new Exception('Could not read .env file!');
}

$env = explode("\n", $env);
$setKeys = [];
$mandatoryKeys = [
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
foreach ($env as $env_variable) {
    $env_variable = trim($env_variable);

    // Ignore empty lines and comments
    if (empty($env_variable) || substr($env_variable, 0, 1) === '#') { continue; }

    // Parse values with double or single quotes
    if (preg_match('/^(.+)=(["\'])(.+)\2$/', $env_variable, $matches)) {
        $env_key = $matches[1];
        $env_value = $matches[3];
    } else {
        list($env_key, $env_value) = explode("=", $env_variable, 2);
    }

    if (putenv("$env_key=$env_value")) {
        $setKeys[] = $env_key;
    } else {
        throw new Exception("Failed to set environment variable $env_key!");
    }
}

// Check if all mandatory keys are set
foreach ($mandatoryKeys as $key) {
    if (!in_array($key, $setKeys)) {
        throw new Exception("Mandatory environment variable $key is not set, please create this key to the project's .env file!");
    }
}