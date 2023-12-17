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
function translate($translation_key, $variables = array(""))
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

    // Incase we can not find translation with a key we should check can we find translation that matches he key
    // We do this to allow the user translate like this: tarnslate("Hello there, how are you {s}?", $username);
    // Compared to: translate("hello_message", $username)
    if (!array_key_exists($translation_key, $translations))
    {
        // Check does the translation key match any translation
        foreach ($translations as $key => $value)
        {
            foreach ($value as $translation)
            {
                if ($translation_key == $translation)
                {
                    $translation_key = $key;
                    break;
                }
            }
        }

        // Display JavaScript warning about missing translation
        ?><script>console.warn("PHP translator was not able to translate key: <?= $translation_key; ?>!");</script><?php
        return "";
    }


    // Get valid languages
    foreach ($translations[$translation_key] as $lang => $value)
    {
        $valid_languages[$lang] = $lang;
    }


    // Check if given language is found from translation
    if (array_key_exists($language, $valid_languages))
    {
        return vsprintf($translations[$translation_key][$language], $variables);
    }
    else
    {
        ?><script>console.warn("PHP translator was not able to translate key: <?= $translation_key; ?> with language: <?= $language; ?>!");</script><?php
        return (array_key_exists(DEFAULT_LANGUAGE, $valid_languages)) ? vsprintf($translations[$translation_key][DEFAULT_LANGUAGE], $variables) : "";
    }
}
