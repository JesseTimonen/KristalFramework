<?php defined("ACCESS") or exit("Access Denied");

// Require parent router
use Backend\Core\Router;

// Optional controllers, entities, etc.
use Backend\Controllers\ThemeController;


class Routes extends Router
{
    public function __construct()
    {
        // Activate Router
        parent::__construct();

        // Route for home
        parent::register("", "frontPageHandler");

        // Route for demo (in english and finnish)
        parent::register("demo", "demoHandler");
        parent::register("esittely", "demoHandler");

        // function to handle 404s
        parent::setDefaultHandler("pageNotFoundHandler");

        // Let router handle the routes
        parent::handleRoutes();
    }



    function frontPageHandler()
    {
        // Render() method will render a page template from your pages folder
        // For example the following line will render content from /App/Pages/frontpage.php
        $this->render("frontpage");
    }

    

    // Variables are passed into the route the following way:
    // "example.com/route/variable1/variable2/..."
    // Just add more variables to accept them as well
    function demoHandler($selected_theme = null)
    {
        // Create instance of theme controller, so we can change theme with it
        $theme_controller = new ThemeController();

        // Try to change the theme by calling theme controller which has a custom changeTheme() method
        // Theme controller can be found and modified at App/Backend/Controllers/ folder
        $theme_feedback = "";
        if (!empty($selected_theme)) {
            $theme_feedback = $theme_controller->changeTheme($selected_theme);
        }

        // Render content from App/Pages/demo.php and create $theme_feedback variable that can be used in the template
        $this->render("demo", [
            "theme_feedback" => $theme_feedback,
        ]);
    }



    protected function pageNotFoundHandler()
    {
        // Render content from App/Pages/404.php
        // You could also render home page here
        $this->render("404");
    }
}


// Initialize routes
new Routes();