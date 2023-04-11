<?php namespace Backend\Core;
defined("ACCESS") or exit("Access Denied");

/*==============================================================================*\
|  This class handles logic behind form requests class in the controllers folder |
\*==============================================================================*/

use \ReflectionMethod;


class FormRequest
{
    public function __construct($params = array("allow_protected_calls" => false))
    {
        // Make sure there was a form request
        if ( ! isset($_POST["form_request"])) { return; }

        // Check CSRF
        if (isset($_POST["csrf_token"]) && isset($_POST["csrf_identifier"]))
        {
            if ($_POST["csrf_token"] !== getCSRF($_POST["csrf_identifier"])) { return; }
        }

        // Call the requested function
        if (method_exists($this, $_POST["form_request"]))
        {
            resetCSRF();
            $method = new ReflectionMethod($this, $_POST["form_request"]);

            // Call requested function if eligible
            if ($method->isPublic() || ($method->isProtected() && $params["allow_protected_calls"] === true))
            {
                $this->{$_POST["form_request"]}(array_merge($_REQUEST, $_FILES));
            }
        }
    }
}