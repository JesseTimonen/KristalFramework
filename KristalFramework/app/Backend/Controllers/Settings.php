<?php namespace Backend\Controllers;
defined("ACCESS") or exit("Access Denied");

use Backend\Core\Session;


class Settings
{
    public function changeTheme($theme = null)
    {
        // Make sure theme is not null
        if ($theme === null)
        {
            return false;
        }

        $valid_themes = array("dark", "light");
        $theme = strtolower($theme);

        // Check if given theme is a valid theme
        if (!in_array($theme, $valid_themes, true))
        {
            return false;
        }

        // Add new theme to session
        Session::add("theme", $theme);
        return true;
    }
}