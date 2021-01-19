<?php namespace Backend\Core\Helper\Actions;
defined("ACCESS") or exit("Access Denied");

use Backend\Core\Database;
use \PDO;


class DatabaseBackup extends Database
{
    public function __construct($database)
    {
        // This action can only be performed during developement mode
        if (MAINTENANCE_MODE !== true)
        {
            createError("This action can only be performed while developement mode is active!", true);
        }

        parent::__construct(["database" => $database]);

        $filename = "database_backup_" . date("Y-n-j") . ".sql";
        $backup = $this->databaseBackup();
        $mime = "application/sql";

        /*
        switch ($type)
        {
            case "zip":
                $filename .= ".zip";
                $mime = "application/zip";
            break;

            case "gz":
                $filename .= ".gz";
                $mime = "application/x-gzip";
            break;

            case "sql":
                $mime = "application/sql";
            break;

            default:
                $mime = "application/sql";
            break;
        }
        */

        header("Content-Type: " . $mime);
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        echo $backup;
        exit;
    }
}