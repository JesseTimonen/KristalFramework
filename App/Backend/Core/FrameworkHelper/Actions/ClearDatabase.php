<?php namespace Backend\Core\FrameworkHelper\Actions;
defined("ACCESS") or exit("Access Denied");

use Backend\Core\Database;


class ClearDatabase extends Database
{
    public function __construct($database)
    {
        if (MAINTENANCE_MODE)
        {
            parent::__construct(["database" => $database]);
            $this->ClearDatabase();
        }
    }

    private function ClearDatabase()
    {
        // Drop tables
        $tables = $this->getTables();
        foreach ($tables as $table)
        {
            foreach ($table as $table_name)
            {
                $this->dropTableCascade($table_name);
            }
        }
        
        debug("Database has been successfully Cleared!");
    }
}
