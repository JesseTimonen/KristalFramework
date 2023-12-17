<?php defined("ACCESS") or exit("Access Denied");


// Set language for translator
function setLanguage($language)
{
    Session::add("language", $language);
}


// Get translator's language
function getLanguage()
{
    return Session::has("language") ? Session::get("language") : DEFAULT_LANGUAGE;
}


// Output translation
function ts($translation_key, $variables = array(""))
{
    return translate($translation_key, $variables);
}


// Return translation
function translate($string, $variables = array(""))
{
    // Get translations
    global $translations;
    if (!isset($translations))
    {
        $translations_file_path = 'App/Public/Translations/translations.php';
    
        if (file_exists($translations_file_path))
        {
            $translations = include $translations_file_path;
        }
        else
        {
            throw new Exception("Failed to load translations file! Missing translations.php file at App/Public/Translations/");
        }
    }

    
    // Make sure $variables is an array
    if (!is_array($variables))
    {
        $variables = array($variables);
    }


    // Get translation language
    $language = getLanguage();


    // Return original string if no translation was found
    if (!array_key_exists($string, $translations))
    {
        return $string;
    }


    // Get valid languages
    foreach ($translations[$string] as $lang => $value)
    {
        $valid_languages[$lang] = $lang;
    }


    // Check if given language is found from translation
    if (array_key_exists($language, $valid_languages))
    {
        return vsprintf($translations[$string][$language], $variables);
    }
    else
    {
        return $string;
    }
}
