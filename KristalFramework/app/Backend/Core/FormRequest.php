<?php namespace Backend\Core;
defined("ACCESS") or exit("Access Denied");

/*==============================================================================*\
|  This class handles logic behind form requests class in the controllers folder |
\*==============================================================================*/

use \ReflectionMethod;


class FormRequest
{
    private $requested_method = "";


    public function __construct($params = array("allow_protected_calls" => false))
    {
        // Sanitize $_POST variables
        $_POST = array_map('htmlspecialchars', $_POST);

        // Make sure there was a form request
        if (!isset($_POST["form_request"]))
        {
            return;
        }

        // Check CSRF
        if (isset($_POST["csrf_token"]) && isset($_POST["csrf_identifier"]))
        {
            if ($_POST["csrf_token"] !== getCSRF($_POST["csrf_identifier"]))
            {
                return;
            }

            resetCSRF();
        }

        // Get requested method
        $this->requested_method = $_POST["form_request"];
        
        // Call the requested function
        if (method_exists($this, $this->requested_method))
        {
            $method = new ReflectionMethod($this, $this->requested_method);

            // Call requested function if eligible
            if ($method->isPublic() || ($method->isProtected() && $params["allow_protected_calls"] === true))
            {
                $this->{$this->requested_method}(array_merge($_REQUEST, $_FILES));
            }
        }
    }
}