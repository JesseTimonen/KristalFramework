<?php defined("ACCESS") or exit("Access Denied");

// Reset CSRF protection if it doesn't exist
if (!Session::has("csrf")) { resetCSRF(); }


// Reset CSRF
function resetCSRF()
{
    Session::add("csrf-default", bin2hex(random_bytes(32)));
}


// Create new CSRF token
function createNewCSRF($identifier = "default")
{
    Session::add("csrf-" . $identifier, bin2hex(random_bytes(32)));
}


// Return current CSRF token
function getCSRF($identifier = "default")
{
    if (!Session::has("csrf-" . $identifier)) { return false; }
    return Session::get("csrf-" . $identifier);
}


// Echo form request input field
function request($action)
{
    echo "<input type='hidden' name='form_request' value='$action'>";
}


// Echo csrf form inputs
function csrf($identifier = "default")
{
    if (!Session::has("csrf-" . $identifier))
    {
        createNewCSRF($identifier);
    }

    echo "<input type='hidden' name='csrf_identifier' value='" . $identifier . "'>";
    echo "<input type='hidden' name='csrf_token' value='" . Session::get("csrf-" . $identifier) . "'>";
}