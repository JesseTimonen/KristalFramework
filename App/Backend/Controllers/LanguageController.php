<?php namespace Backend\Controllers;
defined("ACCESS") or exit("Access Denied");

use Backend\Core\Session;


class LanguageController
{
    public function changeLanguage($language = null)
    {
        if (in_array($language, unserialize(AVAILABLE_LANGUAGES)))
        {
            Session::add("language", $language);
            redirect(route(""));
        }

        refreshPage();
    }
}