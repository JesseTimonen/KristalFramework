<?php namespace Backend\Controllers;
defined("ACCESS") or exit("Access Denied");

use Backend\Core\Session;


class Settings
{
    public function changeTheme($theme = null)
    {
        // Make sure theme is not null
        if ($theme === null) {
            return false;
        }

        $theme = strtolower($theme);
        $valid_themes = ["dark", "light"];

        // Check if requested theme is valid
        if (!in_array($theme, $valid_themes, true)) {
            return false;
        }

        // Add the new theme to session
        Session::add("theme", $theme);
        return true;
    }
}