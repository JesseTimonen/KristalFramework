<?php defined("ACCESS") or exit("Access Denied");

function debug($variable, $name = null)
{
    if (PRODUCTION_MODE) return;

    echo "<hr /><pre style='background-color: #f1f1f1; color: black; padding: 10px; border: 1px solid #black; border-radius: 5px; font-size: 14px;'>";

    if (isset($name)) echo "<strong>Debugging variable:</strong> $name<br><br>";
    echo var_export($variable, true);

    echo "</pre><hr />";
}


function kristal_init_debug() {

    if (!DEBUG_DISPLAY_ERRORS) {
        ini_set('display_errors', '0');
        ini_set('error_reporting', '0');
        return;
    }

    ini_set('display_errors', '1');

    $error_level = 0;

    if (DEBUG_SHOW_ERRORS) {
        $error_level |= E_ERROR;
    }
    if (DEBUG_SHOW_WARNINGS) {
        $error_level |= E_WARNING;
    }
    if (DEBUG_SHOW_NOTICES) {
        $error_level |= E_NOTICE;
    }

    ini_set('error_reporting', $error_level);
}

kristal_init_debug();