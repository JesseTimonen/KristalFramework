<?php namespace Backend\Core\Helper\Actions;
defined("ACCESS") or exit("Access Denied");

use Backend\Core\Database;


class ClearDatabase extends Database
{
    public function __construct($database)
    {
        // This action can only be performed during development mode
        if (MAINTENANCE_MODE !== true)
        {
            throw new \Exception("This action can only be performed while development mode is active!");
        }

        parent::__construct(["database" => $database]);

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
