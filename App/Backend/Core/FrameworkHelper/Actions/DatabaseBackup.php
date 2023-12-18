<?php namespace Backend\Core\FrameworkHelper\Actions;
defined("ACCESS") or exit("Access Denied");

use Backend\Core\Database;
use \PDO;


class DatabaseBackup extends Database
{
    public function __construct($database)
    {
        if (MAINTENANCE_MODE)
        {
            parent::__construct(["database" => $database]);
            $this->BackupDatabase();
        }
    }


    private function BackupDatabase()
    {
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
