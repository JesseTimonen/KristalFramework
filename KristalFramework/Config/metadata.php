<?php defined("ACCESS") or exit("Access Denied");
/**
 * This file tell the framework how metadata should be added to the header
 */

return array(

    // Metadata for home page
    "home" => (object) array(
        "type" => "website",                            // Type of the website
        "author" => "________",                         // Author name used for search engines
        "publisher" => "________",                      // Publisher name used for search engines
        "url" => '________',                            // URL of you website
        "title" => "________",                          // Page title displayed in the browser tab
        "og:title" => "________",                       // Page title displayed in social media search engines
        "description" => "________",                    // Description which helps search engines determine what the page is about
        "og:description" => "________",                 // Description which helps social media search engines determine what the page is about
        "keywords" => "Key, Words, Here",               // Keywords which helps search engines determine what the page is about
        "robots" => "all",                              // Use "none" to prevent search engines and "all" to let them have access to your website
    ),

    // Metadata from '/demo' page
    "demo" => (object) array(
        "type" => "website",
        "author" => "________",
        "publisher" => "________",
        "url" => '________',
        "title" => "________",
        "og:title" => "________",
        "description" => "________",
        "og:description" => "________",
        "keywords" => "Key, Words, Here",
        "robots" => "all",
    ),

    // Metadata for every other page
    "*" => (object) array(
        "type" => "website",
        "author" => "________",
        "publisher" => "________",
        "url" => '________',
        "title" => "________",
        "og:title" => "________",
        "description" => "________",
        "og:description" => "________",
        "keywords" => "Key, Words, Here",
        "robots" => "all",
    ),

);