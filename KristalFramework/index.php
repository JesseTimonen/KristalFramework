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


    // Routes
    protected function routeController($page, $variables)
    {
        switch ($page)
        {
            case "": $this->callView("home"); break;
            case "/": $this->callView("home"); break;
            case "about": $this->callView("about"); break;
            case "theme": $this->callView("theme", $variables); break;
            case "mail": $this->callView("mail"); break;
            default: $this->callView("pageNotFound"); break;
        }
    }


    protected function home()
    {
        // Render function will render a page from your pages folder
        // For example the following line will render content from /app/pages/home.php
        $this->render("home");
    }


    function about()
    {
        // Render content from app/pages/about.php
        $this->render("about");
    }

    
    function theme()
    {
        // Render content from app/pages/theme.php
        $this->render("theme");
    }


    function mail()
    {
        // Render content from app/pages/mail.php
        $this->render("mail");
    }


    function pageNotFound()
    {
        // Render content from app/pages/404.php
        $this->render("404");
    }
}


// Initialize routes
new Routes();