<?php namespace Backend\Core\Helper\Actions;
defined("ACCESS") or exit("Access Denied");

use Backend\Core\Database;


class ClearDatabase extends Database
{
    public function __construct($database)
    {
        // This action can only be performed during developement mode
        if (MAINTENANCE_MODE !== true)
        {
            createError("This action can only be performed while developement mode is active!", true);
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

        createNotification("Database has been successfully Cleared!", true);
    }
}