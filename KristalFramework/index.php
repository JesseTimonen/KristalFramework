<?php include "app/Backend/Core/Init.php";

/*============================================================================================*\
|  This file specifies routes for your application.                                            |
|                                                                                              |
|  Routes can be found inside the Routes class, these routes are in a form of a function,      |
|  where the name of the function is the URL address you want to called to enter the page and  |
|  the parameters are variables you can pass through the URL.                                  |
|                                                                                              |
|  Incase PHP doesn't allow function name to be a route you want to have,                      |
|  you can specify special routes in the undefinedRoutes function                              |
|                                                                                              |
|  To render a page call $this->render("xxxx") function.                                       |
\*============================================================================================*/

// Require core features
use Backend\Core\Router;

// Optional controllers, entities, etc.
use Backend\Controller\Settings;
use Backend\DBInterface\Users;
use Backend\Entity\User;


class Routes extends Router
{
    private $settings;
    private $db_users;
    private $user;


    public function __construct()
    {
        // Create instance of your optional controllers, entities, etc.
        $this->settings = new Settings();

        // You should only call entities after you have given valid database configurations in the config file
        // $this->db_users = Users::getInstance();
        // $this->user = new User();

        // Activate Router
        parent::__construct();
    }


    // Route for home page
    // You are not able to call protected routes from URL request (www.example.com/home)
    // Protected/private functions can only be called internally, usually they are called from another route function or from undefinedRoutes() function
    // For example this function is called from undefinedRoutes() when the page request is empty, meaning the request is only the server's base address (www.example.com)
    protected function home()
    {
        // Render function will render a page from your pages folder
        // For example the following line will render content from /app/pages/home.php
        $this->render("home");
    }


    // Route for www.example.com/about
    function about()
    {
        // Render content from app/pages/about.php
        $this->render("about");
    }


    // Route for www.example.com/theme/{theme}
    // By giving route function parameters, you are able to take variables from the URL request (www.example.com/theme/variable)
    // Remember to always give these parameters a default value or PHP will return an error when calling them without parameters
    function theme($theme = null)
    {
        // Render content from app/pages/theme.php
        $this->render("theme", [
            "theme_change_success" => $this->settings->changeTheme($theme),     // Call settings controller and give the returned value to $theme_change_success variable, which will be passed to the page
            "theme" => $theme,                                                  // Pass $theme variable to the page
        ]);
    }


    // Route for www.example.com/mail
    function mail()
    {
        $this->render("mail");
    }


    // Route for www.example.com/full
    function full()
    {
        // You can render multiple sites at once by calling render() function multiple times
        $this->render("home");
        $this->render("about");
        $this->render("theme");
    }


    // Function called when no other page matches the URL request, usually called from undefinedRoutes function if no valid page is found from URL request
    protected function pageNotFound($page = null)
    {
        // Display URL request for debugging if maintenance mode is enabled
        if (MAINTENANCE_MODE && $page !== null){ createError("Could not find route for page <u>$page</u>!"); }

        // Display 404 page, you can also redirect to home route function instead of rendering 404 error page
        $this->render("404"); // $this->callView("home");
    }


    // If no function match the requested URL, the request will be passed here
    protected function undefinedRoutes($page, $variables)
    {
        switch ($page)
        {
            case "": $this->callView("home"); break;                        // www.example.com
            case "/": $this->callView("home"); break;                       // www.example.com/
            case "T H E M E": $this->callView("theme", $variables); break;  // www.example.com/T H E M E
            case "*": $this->callView("full", $variables); break;           // www.example.com/*
            default: $this->callView("pageNotFound", $page); break;         // If nothing above match the page URL (You can also call the home view here to avoid any 404 errors)
        }
    }
}

// Initialize routes
new Routes();