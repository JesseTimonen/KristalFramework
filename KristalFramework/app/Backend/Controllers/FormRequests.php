<?php namespace Backend\Controllers;
defined("ACCESS") or exit("Access Denied");

use Backend\Core\FormRequest;
use Backend\Core\Mailer;
use Backend\Controllers\Settings;


class FormRequests extends FormRequest
{
    public function __construct()
    {
        // You can specify your own condition in the IF statement to protect protected functions
        // For example $_SESSION["logged_in"] or $_SESSION["role"] === "admin"
        // Protected function can only be called when "parent::__construct(["allow_protected_calls" => false]);" is called
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
        $request = array_map('htmlspecialchars', $request);
        $settings = new Settings();
        $settings->changeTheme($request["theme"]);
    }


    // Form request for sending email
    public function send_mail($request)
    {
        $request = array_map('htmlspecialchars', $request);

        if (!filter_var($request["receiver"], FILTER_VALIDATE_EMAIL)) {
            // Handle the invalid email address case.
            return;
        }

        $mailer = new Mailer();
        $mailer->send(
            $request["receiver"],               // Receiver (can be an array of receivers)
            translate("example_email_title"),   // Email title
            getLanguage() . "/welcome.php",     // Email template (from app/public/email/)
            array(                              // Array of variables you wish to pass to the email template
                "name" => $request["receiver"],
            )
        );
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