<?php namespace Backend\Controllers;
defined("ACCESS") or exit("Access Denied");

use Backend\Core\FormRequest;
use Backend\Controllers\ThemeController;


class FormRequests extends FormRequest
{
    public function __construct()
    {
        // Protected function can only be called when parent::__construct() is called with ["allow_protected_calls" => true] parameter
        // You can specify your own condition in the IF statement if you want to access protected functions from form requests
        // For example $_SESSION["logged_in"] or $_SESSION["role"] === "admin"
        if (false)
        {
            // Allow form requests to access protected functions
            parent::__construct(["allow_protected_calls" => true]);
        }
        else
        {
            // Allow form requests to access only public functions
            parent::__construct(["allow_protected_calls" => false]);
        }
    }


    // Form Request for changing theme
    public function change_theme($request) // $request variable contains all data sent by the form
    {
        $Theme_controller = new ThemeController();
        $Theme_controller->changeTheme($request["theme"]);
    }



    // Protected functions can only be called when the parent class is constructed with 'true' parameter or internally from other functions
    protected function xxxxxxxx($request)
    {
        // ...
    }


    // Private functions can only be called internally from other functions within this class
    private function xxxxxxx($request)
    {
        // ...
    }
}