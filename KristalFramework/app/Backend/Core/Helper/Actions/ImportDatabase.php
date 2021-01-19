<?php namespace Backend\Core\Helper\Actions;
defined("ACCESS") or exit("Access Denied");

use Backend\Core\Database;


class ImportDatabase extends Database
{
    public function __construct($file)
    {
        // This action can only be performed during developement mode
        if (MAINTENANCE_MODE !== true)
        {
            createError("This action can only be performed while developement mode is active!", true);
        }

        // Get primary database
        $database = "primary";
        $databases = unserialize(DATABASES);
        foreach ($databases as $name => $info)
        {
            $database = $name;
        }

        parent::__construct(["database" => $database]);

        try
        {
            // Make sure file doesn't have any errors
            if (isset($file["error"]))
            {
                if ($file["error"] !== 0)
                {
                    createError(["Your file had an error with code: {$file['error']}!", "<a href = 'https://www.php.net/manual/en/features.file-upload.errors.php' target = '_blank'>See PHP documentation to see what this error means.</a>", true]);
                }
            }


            // Make sure given file is in sql format
            $file_extension = substr($file["name"], strrpos($file["name"], '.') +1);
            if ($file_extension !== "sql")
            {
                createError(["Imported file needs to be in 'sql' format!", "Given file was in '$file_extension' format"]);
            }


            // Read the file
            $lines = file($file["tmp_name"]);
            $insert_line = "";

            // Insert the lines into database
            foreach ($lines as $line)
            {
                // Skip it if it's a comment
                if (substr($line, 0, 2) == "--" || $line == "") continue;

                // Add this line to the current segment
                $insert_line .= $line;

                // If it has a semicolon at the end, it's the end of the query
                if (substr(trim($line), -1, 1) == ";")
                {
                    $this->execute($insert_line, array());
                    $insert_line = "";
                }
            }

            createNotification("Database has been successfully updated!", true);
        }
        catch (Exception $e)
        {
            createError("Failed to import database file!", true);
        }
    }
}