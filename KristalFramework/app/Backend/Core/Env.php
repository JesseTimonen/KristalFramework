<?php

// Read .env variables
$env = file_get_contents('.env');
$env = explode("\n", $env);

foreach ($env as $env_variable)
{
    $env_variable = trim($env_variable);

    // Ignore empty lines and comments
    if (empty($env_variable) || substr($env_variable, 0, 1) === '#') { continue; }

    putenv($env_variable);
}