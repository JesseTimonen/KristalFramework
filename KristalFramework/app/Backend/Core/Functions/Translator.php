<?php defined("ACCESS") or exit("Access Denied");


// Set language for translator
function setLanguage($language)
{
    $_SESSION["translation_language"] = $language;
}


// Get translator's language
function getLanguage()
{
    return (isset($_SESSION["translation_language"]) ? $_SESSION["translation_language"] : DEFAULT_LANGUAGE);
}


// Output translation
function ts($translation_key, $variables = array(""))
{
    translate($translation_key, $variables, true);
}


// Return translation
function trans($translation_key, $variables = array(""))
{
    return translate($translation_key, $variables, false);
}


// Return translation
function translate($translation_key, $variables = array(""), $output = false)
{
    // Get translations
    global $translations;
    if (!isset($translations))
    {
        $translationsFilePath = 'app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'translations' . DIRECTORY_SEPARATOR . 'translations.php';
    
        if (file_exists($translationsFilePath))
        {
            $translations = include $translationsFilePath;
        }
        else
        {
            createError(["Failed to load translations file!", "Missing translations.php file at app" . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR . "translations" . DIRECTORY_SEPARATOR]);
        }
    }

    // Make sure $variables is an array
    if (!is_array($variables))
    {
        $variables = array($variables);
    }

    // Get translation language
    $language = getLanguage();

    // Check is translation found
    if (!array_key_exists($translation_key, $translations))
    {
        $not_found = true;

        // Try to find possible match for translation from the content of translations
        foreach ($translations as $key => $value)
        {
            foreach ($value as $translation)
            {
                if (strpos($translation_key, $translation) !== false)
                {
                    $not_found = false;
                    $translation_key = $key;
                    break;
                }
            }
            if (!$not_found) break;
        }

        if ($not_found)
        {
            // Try to find possible match for translation
            foreach ($translations as $key => $value)
            {
                // Check if translation key is found within the requested key
                if (strpos($key, $translation_key) !== false)
                {
                    $not_found = false;
                    $translation_key = $key;
                    break;
                }
                else if (strpos($translation_key, $key) !== false)
                {
                    $not_found = false;
                    $translation_key = $key;
                    break;
                }
            }
        }
    }


    if ($not_found)
    {
        // Display JavaScript warning about missing translation
        ?><script>console.warn("PHP translator was not able to translate key: <?= $translation_key ?>!");</script><?php
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
        if ($output)
        {
            vprintf($translations[$translation_key][$language], $variables);
        }
        else
        {
            return vsprintf($translations[$translation_key][$language], $variables);
        }
    }
    else
    {
        ?><script>console.warn("PHP translator was not able to translate key: <?= $translation_key ?> with language: <?= $language ?>!");</script><?php
        return "";
    }
}