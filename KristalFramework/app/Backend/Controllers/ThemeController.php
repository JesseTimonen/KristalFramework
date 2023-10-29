<?php namespace Backend\Controllers;
defined("ACCESS") or exit("Access Denied");

use Backend\Core\Session;


class ThemeController
{
    private $themes_folder_path = "app" . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR . "css" . DIRECTORY_SEPARATOR;


    public function changeTheme($theme = null)
    {
        // Make sure theme is not null
        if ($theme === null) {
            return false;
        }
    
        // Format theme name: remove the file extension, convert to lowercase and add .css extension
        $formatted_theme_name = strtolower(pathinfo($theme, PATHINFO_FILENAME)) . 'css';
    
        // Check if the theme file exists
        if (!file_exists($this->themes_folder_path . $formatted_theme_name)) {
            return false;
        }
    
        // Add the new theme to session
        Session::add("theme", $formatted_theme_name);
        return true;
    }
}