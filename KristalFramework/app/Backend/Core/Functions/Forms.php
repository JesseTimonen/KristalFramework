<?php defined("ACCESS") or exit("Access Denied");


// Reset CSRF protection if it doesn't exist
if (!isset($_SESSION["csrf"])) { resetCSRF(); }


// Reset CSRF
function resetCSRF()
{
    $_SESSION["csrf"] = array("default" => md5(mt_rand()));
}


// Create CSRF token
function createNewCSRF($identifier = "default")
{
    if (!isset($_SESSION["csrf"]))
    {
        resetCSRF();
    }
    
    $_SESSION["csrf"] = array_merge(
        $_SESSION["csrf"],
        array($identifier => md5(mt_rand()))
    );
}


// Return current CSRF token
function getCSRF($identifier = "default")
{
    return $_SESSION["csrf"][$identifier];
}


// Echo form request form input
function request($action)
{
    echo "<input type = 'hidden' name = 'form_request' value = '$action'>";
}


// Echo csrf form inputs
function csrf($identifier = "default")
{
    if (!isset($_SESSION["csrf"][$identifier]))
    {
        createNewCSRF($identifier);
    }

    echo "<input type = 'hidden' name = 'csrf_identifier' value = '$identifier'>";
    echo "<input type = 'hidden' name = 'csrf_token' value = '{$_SESSION['csrf'][$identifier]}'>";
}