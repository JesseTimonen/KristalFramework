<?php namespace Backend\Core\FrameworkHelper\Actions;
defined("ACCESS") or exit("Access Denied");

use Backend\Core\FormRequest;
use Backend\Core\FrameworkHelper\Actions\DatabaseBackup;
use Backend\Core\FrameworkHelper\Actions\ImportDatabase;
use Backend\Core\FrameworkHelper\Actions\ClearDatabase;
use Backend\Core\FrameworkHelper\Actions\CreatorTool;
use Backend\Core\Session;


class FrameworkHelper extends FormRequest
{
    public function __construct()
    {
        if (Session::has("maintenance_access_granted") && MAINTENANCE_MODE && !empty($_POST["csrf_identifier"]))
        {
            $csrfToken = CSRF::get($_POST["csrf_identifier"]);
        
            if (!empty($csrfToken) && password_verify(SESSION_NAME . $csrfToken . $_SESSION["visitor_identity"], $_POST["authentication"]))
            {
                parent::__construct(["allow_protected_calls" => true]);
            }
        }
    }


    protected function database_backup($request)
    {
        new DatabaseBackup($request["database"]);
    }


    protected function import_database($request)
    {
        new ImportDatabase($request["database-import"]);
    }


    protected function clear_database($request)
    {
        new ClearDatabase($request["database"]);
    }


    protected function create_entity($request)
    {
        $creator = new CreatorTool();
        $creator->createEntity($request);
    }


    protected function create_controller($request)
    {
        $creator = new CreatorTool();
        $creator->createController($request["controller-name"]);
    }
}
