<?php namespace Backend\Core\Helper\Actions;
defined("ACCESS") or exit("Access Denied");

use Backend\Core\FormRequest;
use Backend\Core\Helper\Actions\DatabaseBackup;
use Backend\Core\Helper\Actions\ImportDatabase;
use Backend\Core\Helper\Actions\ClearDatabase;
use Backend\Core\Helper\Actions\CreatorTool;


class FrameworkHelper extends FormRequest
{
    public function __construct()
    {
        if ($_SESSION["maintenance_access_granted"] === true && MAINTENANCE_MODE === true && password_verify(SESSION_NAME . getCSRF($_POST["csrf_identifier"]) . $_SESSION["IP_address"], $_POST["authentication"]))
        {
            parent::__construct(["allow_protected_calls" => true]);
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