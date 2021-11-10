<?php namespace Backend\Core;
defined("ACCESS") or exit("Access Denied");

use \ZipArchive;


class Update
{
    private $download_source = "https://jessetimonen.fi/kristal/app/public/downloads/updates/Kristal_Framework_Update_" . VERSION_NUMBER . ".zip";
    private $download_destination = BASE_PATH . "app/Backend/Core/Updates/Kristal_Framework_Update_" . VERSION_NUMBER . ".zip";
    private $downloaded_files_folder = BASE_PATH . "app/Backend/Core/Updates/Kristal_Framework_Update_" . VERSION_NUMBER . "/";
    private $extract_folder = BASE_PATH . "app/Backend/Core/Updates/";


    public function __construct()
    {
        $this->downloadUpdate();
        $this->overwriteFiles();
        $this->deleteDownloadedFiles();
        createNotification("Framework has been updated to version " . VERSION_NUMBER);
    }


    private function downloadUpdate()
    {
        try
        {
            // Check does requested version exist
            $url = "https://www.jessetimonen.fi/kristal/api/version_exists/" . VERSION_NUMBER;
            $content = file_get_contents($url);
            $content = filter_var($content, FILTER_VALIDATE_BOOLEAN);
    
            if ($content)
            {
                // Download files
                if (copy($this->download_source, $this->download_destination))
                {
                    // Extract downloaded files
                    $zip = new ZipArchive;
                    $zip_result = $zip->open($this->download_destination);

                    if ($zip_result)
                    {
                        $zip->extractTo($this->extract_folder);
                        $zip->close();
                    }
                    else
                    {
                        createError("Failed to extract downloaded files, make sure server has permission to write into app/Backend/Core/Updates/ folder");
                    }
                }
            }
            else
            {
                createError("Failed to download files, version " . VERSION_NUMBER . " does not exist, please revert version number back to " . CURRENT_VERSION_NUMBER . " from config file");
            }
        }
        catch (\Exception $exception)
        {
            createError("Update failed due to php error, please revert version number back to " . CURRENT_VERSION_NUMBER . " from config file");
        }
    }


    private function overwriteFiles()
    {
        if (file_exists($this->downloaded_files_folder . "LICENSE")) { rename($this->downloaded_files_folder . "LICENSE", BASE_PATH . "LICENSE"); }
        if (file_exists($this->downloaded_files_folder . "app/public/javascript/core.js")) { rename($this->downloaded_files_folder . "app/public/javascript/core.js", BASE_PATH . "app/public/javascript/core.js"); }
        $this->overwriteFilesFromFolder("app/public/javascript/core/");
        $this->overwriteFilesFromFolder("app/Backend/Core/Helper/Actions/");
        $this->overwriteFilesFromFolder("app/Backend/Core/Helper/templates/");
        $this->overwriteFilesFromFolder("app/Backend/Core/Helper/");
        $this->overwriteFilesFromFolder("app/Backend/Core/Functions/");
        $this->overwriteFilesFromFolder("app/Backend/Core/");
    }


    function overwriteFilesFromFolder($folder)
    {
        $files = glob($this->downloaded_files_folder . $folder . "*");
        foreach($files as $file)
        {
            if (file_exists($this->downloaded_files_folder . $folder . basename($file)))
            {
                if (!is_dir($this->downloaded_files_folder . $folder . basename($file)))
                {
                    rename($this->downloaded_files_folder . $folder . basename($file), BASE_PATH . $folder . basename($file));
                }
            }
        }
    }


    private function deleteDownloadedFiles()
    {
        // Delete downloaded files
        $files_to_delete = glob($this->extract_folder . "*");
        foreach ($files_to_delete as $file_to_delete)
        {
            if (is_file($file_to_delete))
            {
                unlink($file_to_delete);
            }
            else
            {
                $this->deleteDownloadedFolder($file_to_delete);
            }
        }
    }


    private function deleteDownloadedFolder($directory_path)
    {
        // Make sure we are deleting a directory
        if (!is_dir($directory_path)) { return; }

        // Add "/" if needed
        if (substr($directory_path, strlen($directory_path) - 1, 1) != '/')
        {
            $directory_path .= '/';
        }

        // Delete files and folders recursively
        $files_to_delete = glob($directory_path . '*', GLOB_MARK);
        foreach ($files_to_delete as $file_to_delete)
        {
            if (is_dir($file_to_delete))
            {
                $this->deleteDownloadedFolder($file_to_delete);
            }
            else
            {
                unlink($file_to_delete);
            }
        }
        rmdir($directory_path);
    }
}

new Update();