<?php include "App/Backend/Core/Framework.php";

// Require parent router
use Backend\Core\Router;

// Optional controllers, entities, etc.
use Backend\Controllers\ThemeController;


class Routes extends Router
{
    private $theme_controller;


    public function __construct()
    {
       // Create instance of your optional controllers, entities, etc.
        $this->theme_controller = new ThemeController();

        // Activate Router
        parent::__construct();
    }


    // Routes
    // The routeController() function is where you define all the routes for your website
    // The structure of a route looks like "domain.com/page/variable/another-variable...", where the page and variables can be customized
    // Inside the routeController() function, you have access to the requested page and any variables that may come along with it
    protected function routeController($page, $variables)
    {
        switch ($page)
        {
            // If you want to add a new route, simply list it within the routeController() function
            // The callView() method is used to activate a particular function found in this file
            // If the route needs variables passed to the url you can include those by adding $variables as the second argument in the callView() method
            // The $variables parameter holds an array of all the variables that are part of the URL
            case "": $this->callView("home"); break;
            case "/": $this->callView("home"); break;
            case "home": $this->callView("home"); break;
            case "theme": $this->callView("theme", $variables); break;
            default: $this->callView("pageNotFound"); break;
        }
    }


    function home()
    {
        // Render() method will render a page template from your pages folder
        // For example the following line will render content from /App/Pages/home.php
        $this->render("home");
    }

    
    // Even though an array of variables was passed to callView(), each element in the array becomes an individual parameter
    function theme($selected_theme = null, $additional_variables = null)
    {
        $feedback = "";

        if (!empty($selected_theme)) {
            // try to change the theme by calling theme controller which has a custom changeTheme() method
            // theme controller can be found at App/Backend/Controllers/ folder
            $feedback = $this->theme_controller->changeTheme($selected_theme) ? translate("change_theme_successful_message", [$selected_theme]) : translate("change_theme_failed_message", [$selected_theme]);
        }

        // Render content from App/Pages/theme.php and create $message variable that can be used in the template
        $this->render("theme", [
            "message" => $feedback,
        ]);
    }


    function pageNotFound()
    {
        // Render content from App/Pages/404.php
        // You can also just point back to home with:
        // $this->callView("home");
        $this->render("404");
    }
}


// Initialize routes
new Routes();