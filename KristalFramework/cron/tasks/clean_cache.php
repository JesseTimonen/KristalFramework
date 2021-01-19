
<?php defined("ACCESS") or exit("Access Denied");

foreach (glob(BASE_PATH . "cache/*") as $file)
{
    if (file_exists($file))
    {
        unlink($file);
    }
}