
<?php defined("ACCESS") or exit("Access Denied");

// Example task for cron jobs
// Deletes files from cache folder

foreach (glob(BASE_PATH . "cache/*") as $file)
{
    if (file_exists($file))
    {
        unlink($file);
    }
}