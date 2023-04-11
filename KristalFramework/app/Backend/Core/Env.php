<?php

// Read .env variables
$env = file_get_contents('.env');
$env = explode("\n", $env);

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

    putenv("$env_key=$env_value");
}
