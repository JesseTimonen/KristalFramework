<?php namespace Backend\Core;
defined("ACCESS") or exit("Access Denied");

use Backend\Controllers\FormRequests;
use Backend\Core\Helper\Actions\FrameworkHelper;
use Backend\Core\PHPJS;
use voku\helper\HtmlMin;


class Router
{
    private $rendered_view = "";


    protected function __construct()
    {
        // Init form requests
        new FormRequests();

        // Init Framework helper
        if (DISPLAY_HELPER && MAINTENANCE_MODE && Session::has("maintenance_access_granted"))
        {
            new FrameworkHelper();
        }

        // Generate sitemap.xml
        if (AUTO_COMPILE_SITEMAP)
        {
            $this->generateSitemap();
        }

        // Parse route and variables from url
        $url_request = $this->getURLRequest();

        // Send information to routeController
        $this->routeController($url_request['page'], $url_request['variables']);
    }

    
    private function getURLRequest()
    {
        // Parse page name and variables from the URL
        $root_url = str_replace("index.php", "", $_SERVER["PHP_SELF"]);
        $url_full = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $url_full = substr($url_full, strlen($root_url));
        $url = explode("/", $url_full);

        // Handle multilingual support
        if (ENABLE_LANGUAGES)
        {
            $available_languages = unserialize(AVAILABLE_LANGUAGES);
            $language = strtolower($url[0]);
            $page = isset($url[1]) ? strtolower($url[1]) : "";

            if (DISPLAY_DEFAULT_LANGUAGE_URL)
            {
                if (!in_array($language, $available_languages))
                {
                    Session::add("language", DEFAULT_LANGUAGE);
                    redirect(route($url_full));
                }

                unset($url[0], $url[1]);
            }
            else
            {
                if (in_array($language, $available_languages) && $url[0] != DEFAULT_LANGUAGE)
                {
                    unset($url[0], $url[1]);
                }
                else
                {
                    $language = DEFAULT_LANGUAGE;
                    $page = strtolower($url[0]);
                    unset($url[0]);
                }
            }

            Session::add("language", $language);
        }
        else
        {
            $page = strtolower($url[0]);
            unset($url[0]);
        }

        // Sanitize the page variable
        $page = htmlspecialchars($page, ENT_QUOTES, 'UTF-8');

        // Validate and sanitize URL variables
        $variables_from_url = [];
        foreach ($url as $key => $value) {
            $variables_from_url[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        }

        return ['page' => $page, 'variables' => $variables_from_url];
    }


    private function generateSitemap()
    {
        // Check has routes been modified since last sitemap.xml generation
        $sitemap_last_mod_time = file_exists("sitemap.xml") ? filemtime("sitemap.xml") : 0;
        $routes_file_mod_time = filemtime('Routes/routes.php');
        $should_regenerate_sitemap = $sitemap_last_mod_time < $routes_file_mod_time;

        // Check every page has it's content been modified since last sitemap.xml generation
        $page_files = glob('App/Pages/*.php');
        foreach ($page_files as $page_file)
        {
            if (filemtime($page_file) > $sitemap_last_mod_time)
            {
                $should_regenerate_sitemap = true;
                break;
            }
        }

        if (!$should_regenerate_sitemap)
        {
            return;
        }

        // Parse public routes from the Routes class
        $reflection = new \ReflectionClass('Routes');
        $routes = $reflection->getMethods(\ReflectionMethod::IS_PUBLIC);
        $sitemap = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>');

        foreach ($routes as $method) {
            if ($method->class === 'Routes' && $method->name != "__construct") {
                $route = $method->name;
                $page_path = 'App/Pages/' . $route . '.php';
                $last_mod = file_exists($page_path) ? date('c', filemtime($page_path)) : date('c', $routes_file_mod_time);

                $url = $sitemap->addChild('url');
                $url->addChild('loc', htmlspecialchars(BASE_URL . strtolower($route)));
                $url->addChild('lastmod', $last_mod);
                $url->addChild('priority', '1.00');
            }
        }

        $sitemap->asXML('sitemap.xml');
    }


    protected function callView($page, $variables = array())
    {
        call_user_func_array(array($this, $page), (array)$variables);
    }


    private function minifyHTML($buffer)
    {
        $minified_HTML = new HtmlMin();
        return $minified_HTML->minify($buffer);
    }


    protected function render($page, array $variables = array())
    {
        // Make sure only one view can be called
        if (!empty($this->rendered_view)) { throw new \Exception("Page: '" . $page . "' can not be rendered because the framework has already rendered page: '" . $this->rendered_view . "'!"); }

        echo "<!-- Page Generated by Kristal Framework -->\n";

        // Include variables passed by the route function
        if (!empty($variables))
        {
            extract($variables);
        }
        
        // Include metadata from config.php
        $kristal_metadata = unserialize(METADATA);

        // Start HTML Minification
        if (MINIFY_HTML)
        {
            ob_start(array($this, "minifyHTML"));
        }

        // Include header
        if (!file_exists(page("Base/header.php"))) { throw new \Exception("Failed to build, " . page("Base/header.php") . " was not found!"); }
        include_once page("Base/header.php");

        // Include framework helper
        if (file_exists("App/Backend/Core/FrameworkHelper/frameworkHelper.php") && DISPLAY_HELPER && MAINTENANCE_MODE && Session::has("maintenance_access_granted")) { include_once "App/Backend/Core/FrameworkHelper/frameworkHelper.php"; }

        // Make sure page is a php file
        $page = ensurePHPExtension($page);

        // Include the requested page
        if (!file_exists(page($page))) { throw new \Exception("Tried to render page: " . $page . ", but template was not found at " . page($page) . "!"); }
        include_once page($page);

        // Render PHP created javascript variables and code
        PHPJS::release();

        // Render footer
        if (!file_exists(page("Base/footer.php"))) { throw new \Exception("Failed to build, " . page("Base/footer.php") . " was not found!"); }
        include_once page("Base/footer.php");

        // End HTML Minification
        if (MINIFY_HTML)
        {
            ob_end_flush();
        }
        
        $this->rendered_view = $page;
    }
}