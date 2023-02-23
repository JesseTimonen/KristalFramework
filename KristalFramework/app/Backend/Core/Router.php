<?php namespace Backend\Core;
defined("ACCESS") or exit("Access Denied");

use Backend\Controllers\FormRequests;
use Backend\Core\Helper\Actions\FrameworkHelper;
use Backend\Core\PHPJS;


class Router
{
    private $pre_render_completed = false;


    protected function __construct()
    {
        // Init form requests
        if (class_exists("Backend\Controllers\FormRequests")) { new FormRequests(); }

        // Init Framework helper form requests
        if (DISPLAY_HELPER && MAINTENANCE_MODE && $_SESSION["maintenance_access_granted"])
        {
            if (class_exists("Backend\Core\Helper\Actions\FrameworkHelper"))
            {
                new FrameworkHelper();
            }
        }

        // Parse route from url
        $this->getURLRequest();
    }


    private function getURLRequest()
    {
        // Parse page name and variables from the URL
        $root_url = str_replace("index.php", "", $_SERVER["PHP_SELF"]);
        $url = str_replace($root_url, "", $_SERVER["REDIRECT_URL"]);
        $url = explode("/", $url);
        $page = $url[0];
        unset($url[0]);

        $this->routeController($page, $url);
        if (file_exists(page("layouts/footer.php"))) include_once page("layouts/footer.php");
    }


    private function preRender()
    {
        // Only render this section once
        if ($this->pre_render_completed){ return; }
        $this->pre_render_completed = true;

        // Include metadata from config.php
        $metadata = unserialize(METADATA);

        echo "<!-- Page Generated by Kristal Framework -->\n";

        // Minify HTML
        if (MINIFY_HTML)
        {
            ob_start(array($this, "minifyHTML"));
        }

        // Include essential page sections
        if (file_exists(page("layouts/header.php"))) include_once page("layouts/header.php");
        if (file_exists("app/Backend/Core/Helper/frameworkHelper.php") && DISPLAY_HELPER && MAINTENANCE_MODE && $_SESSION["maintenance_access_granted"]) include_once "app/Backend/Core/Helper/frameworkHelper.php";

        // Add PHP variables to be used by JavaScript
        PHPJS::addJSVariable([
            "production_mode" => (PRODUCTION_MODE ? "true" : "false"),
            "language" => (isset($_SESSION["translation_language"])) ? $_SESSION["translation_language"] : DEFAULT_LANGUAGE,
        ]);
    }


    private function minifyHTML($buffer)
    {
        $replace = array(
            '/\>[^\S ]+/s' => '>',      // strip whitespaces after tags, except space
            '/[^\S ]+\</s' => '<',      // strip whitespaces before tags, except space
            '/(\s)+/s' => '\\1',        // shorten multiple whitespace sequences
            '/<!--(.|\s)*?-->/' => '',  // Remove HTML comments
            "/ = '/" => "='",           // Remove whitespaces around '='
            '/ = "/' => '="',           // Remove whitespaces around '='
            "/= '/" => "='",            // Remove whitespaces around '='
            '/= "/' => '="',            // Remove whitespaces around '='
            "/ ='/" => "='",            // Remove whitespaces around '='
            '/ ="/' => '="'             // Remove whitespaces around '='
        );

        return preg_replace(array_keys($replace), array_values($replace), $buffer);
    }


    protected function callView($page, $variables = array())
    {
        call_user_func_array(array($this, $page), (array)$variables);
    }


    protected function render($page, array $variables = array())
    {
        // Render essential parts of the webpage
        $this->preRender();

        // Include blocks
        foreach (glob("app/Backend/Blocks/*.php") as $block)
        {
            if (file_exists($block)) include_once $block;
        }

        // Make sure page is a php file
        if (substr($page, -4) !== ".php")
        {
            $page .= ".php";
        }

        // Include variables passed by the route function
        if (!empty($variables))
        {
            foreach ($variables as $key => $value)
            {
                ${$key} = $value;
            }
        }

        if (file_exists(page($page))) include page($page);
        else if (file_exists(page("404.php"))) include page("404.php");
    }
}