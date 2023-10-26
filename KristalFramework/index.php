<?php include "app/Backend/Core/Framework.php";

/*============================================================================================*\
|  This file specifies routes for your application.                                            |
|                                                                                              |
|  Routes can be created and managed inside the routeController() function.                    |
|  Routes follow the format of "domain.com/page/variable/variable..."                          |
|  requested page and variables passed to it can be accessed in routeController() function.    |
|                                                                                              |
|                                                                                              |
|  To render a page call the following function.                                               |
|  $this->render("pagename-from-app/pages/");                                                  |
|                                                                                              |
|                                                                                              |
|  To pass variables to rendered page use the following example.                               |
|  $this->render("pagename-from-app/pages/", [                                                 |
|      "variable_1" => $my_variable_1,                                                         |
|      "variable_2" => $my_variable_2,                                                         |
|  ]);                                                                                         |
\*============================================================================================*/

// Require parent router
use Backend\Core\Router;


class Routes extends Router
{
    public function __construct()
    {
        // Activate Router
        parent::__construct();
    }


    // Routes
    protected function routeController($page, $variables)
    {
        switch ($page)
        {
            case "": $this->callView("home"); break;
            case "/": $this->callView("home"); break;
            case "home": $this->callView("home"); break;
            case "theme": $this->callView("theme", $variables); break;
            default: $this->callView("pageNotFound"); break;
        }
    }


    protected function home()
    {
        // Render function will render a page from your pages folder
        // For example the following line will render content from /app/pages/home.php
        $this->render("home");
    }

    
    function theme()
    {
        // Render content from app/pages/theme.php
        $this->render("theme");
    }


    function pageNotFound()
    {
        // Render content from app/pages/404.php
        $this->render("404");
    }
}


// Initialize routes
new Routes();