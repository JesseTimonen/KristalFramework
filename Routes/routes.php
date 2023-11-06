<?php defined("ACCESS") or exit("Access Denied");

// Require parent router
use Backend\Core\Router;

// Optional controllers, entities, etc.
use Backend\Controllers\ThemeController;


class Routes extends Router
{
    // Create variable of your optional controllers, entities, etc.
    private $theme_controller;


    public function __construct()
    {
       // Create instance of your optional controllers, entities, etc.
        $this->theme_controller = new ThemeController();

        // Activate Router
        parent::__construct();
    }


    // Routes
    // The routeController() function is where you define all the routes for your website.
    // The structure of a route looks like "domain.com/page/variable/another-variable...", where the page and variables can be customized
    // inside the routeController() function, you have access to the requested page and any variables that may come along with it.
    protected function routeController($page, $variables)
    {
        switch ($page)
        {
            // If you want to add a new route, simply list it within the routeController() function.
            // The callView() method is used to activate a particular function found in this file.
            // If the route needs variables passed to the url you can include those by adding $variables as the second argument in the callView() method.
            // The $variables parameter holds an array of all the variables that are part of the URL.
            case "": $this->callView("frontpage"); break;
            case "/": $this->callView("frontpage"); break;
            case "frontpage": $this->callView("frontpage"); break;
            case "demo": $this->callView("demo", $variables); break;
            default: $this->callView("pageNotFound"); break;
        }

        // You could also handle your routing as you wish, for example:
        /*
        if ($page === "acccount" && isset($variables["1"]))
        {
            if (variables["1"] == "settings") { $this->callView("accountSettings", $variables); }
            else { $this->callView("account", $variables); }
        }
        */
    }


    function frontpage()
    {
        // Render() method will render a page template from your pages folder
        // For example the following line will render content from /App/Pages/frontpage.php
        $this->render("frontpage");
    }

    
    // Even though an array of variables was passed to callView(), each element in the array is automatically parsed into an individual parameter
    function demo($selected_theme = null, $additional_variables = null)
    {
        // Try to change the theme by calling theme controller which has a custom changeTheme() method
        // Theme controller can be found at App/Backend/Controllers/ folder
        $theme_feedback = "";
        if (!empty($selected_theme)) {
            $theme_feedback = $this->theme_controller->changeTheme($selected_theme);
        }

        // Render content from App/Pages/theme.php and create $message variable that can be used in the template
        $this->render("demo", [
            "theme_feedback" => $theme_feedback,
        ]);
    }


    // If you want route to be private and not be included into sitemap.xml define it as protected
    protected function pageNotFound()
    {
        // Render content from App/Pages/404.php
        // You can also just point back to frontpage with:
        // $this->callView("frontpage");
        $this->render("404");
    }
}


// Initialize routes
new Routes();