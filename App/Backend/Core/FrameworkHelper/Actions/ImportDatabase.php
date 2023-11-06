<?php namespace Backend\Core\Helper\Actions;
defined("ACCESS") or exit("Access Denied");

use Backend\Core\Database;


class ImportDatabase extends Database
{
    public function __construct($file)
    {
        // This action can only be performed during development mode
        if (MAINTENANCE_MODE !== true)
        {
            throw new \Exception("This action can only be performed while development mode is active!");
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
                    throw new \Exception("Your file had an error with code: " . $file['error'] . "! See PHP documentation (https://www.php.net/manual/en/features.file-upload.errors.php) to see what this error means.</a>");
                }
            }


            // Make sure given file is in sql format
            $file_extension = substr($file["name"], strrpos($file["name"], '.') +1);
            if ($file_extension !== "sql")
            {
                throw new \Exception("Imported file needs to be in 'sql' format! Given file was in '$file_extension' format");
            }


            $finfo = new \finfo(FILEINFO_MIME_TYPE);
            $mime_type = $finfo->file($file["tmp_name"]);
            if ($mime_type !== "text/plain" && $mime_type !== "application/sql") {
                throw new \Exception("Imported file needs to be in 'sql' format! Given file MIME type was '$mime_type'");
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

            debug("Database has been successfully updated!");
        }
        catch (Exception $e)
        {
            throw new \Exception('Failed to import database file!');
        }
    }
}