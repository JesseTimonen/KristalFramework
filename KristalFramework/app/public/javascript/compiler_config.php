<?php defined("ACCESS") or exit("Access Denied");
/**
 * This file handles how javascript files are compiled
 */

return array(
    "core.js" => array(
        "Core/form.js",
        "Core/tooltips.js",
        "Core/translator.js",
    ),
    "maintenance.js" => array(
        "Scripts/maintenance.js",
    ),
    "main.js" => array(
        "Scripts/main.js",
    ),
);