<?php

setcookie(getenv('COOKIE_NAME'), bin2hex(random_bytes(16)), [
    'expires' => time() + getenv('COOKIE_EXPIRE_TIME'),
    'path' => "/",
    'secure' => PRODUCTION_MODE ? true : false, // Ensures the cookie is only sent over HTTPS
    'httponly' => true,                         // Ensures the cookie is not accessible by client-side scripts
]);