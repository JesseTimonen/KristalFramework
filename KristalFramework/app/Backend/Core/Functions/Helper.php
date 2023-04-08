<?php defined("ACCESS") or exit("Access Denied");


function asset($folder, $file, array $params = array("path" => "url"))
{
    $appPublicPath = "app" . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR;

    // Find files using only its name
    if (!file_exists($appPublicPath . $folder . DIRECTORY_SEPARATOR . $file) && !empty($files = glob($appPublicPath . $folder . DIRECTORY_SEPARATOR . $file . "*")))
    {
        $path = strtolower($params["path"]) === "url" ? BASE_URL . $files[0] : $files[0];
        return $path;
    }

    // Return file normally
    $path = strtolower($params["path"]) === "url" ? BASE_URL . $appPublicPath . $folder . DIRECTORY_SEPARATOR . $file : $appPublicPath . $folder . DIRECTORY_SEPARATOR . $file;
    return $path;
}

// ============================================================================================================== \\

function image($file, array $params = array("path" => "url"))
{
    return asset("images", $file, $params);
}

function thumbnail($file_path, array $params = array("path" => "url"))
{
    $thumbnail_path = str_replace("app" . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR . "images" . DIRECTORY_SEPARATOR, "", $file_path);
    $thumbnail_path = str_replace(DIRECTORY_SEPARATOR, "-", $thumbnail_path);
    $thumbnail_path = "app" . DIRECTORY_SEPARATOR . "Backend" . DIRECTORY_SEPARATOR . "Core" . DIRECTORY_SEPARATOR . "thumbnails" . DIRECTORY_SEPARATOR . $thumbnail_path;

    if (!file_exists($thumbnail_path))
    {
        $size = getimagesize($file_path);
        $mime = $size['mime'];

        // Create image
        switch ($mime)
        {
            case 'image/jpeg' : $original = imagecreatefromjpeg($file_path); break;
            case 'image/png' : $original = imagecreatefrompng($file_path); break;
            case 'image/gif' : $original = imagecreatefromgif($file_path); break;
            case 'image/webp' : $original = imagecreatefromwebp($file_path); break;
            default: return null;
        }

        // Create thumbnail
        $thumbnail = imagecreatetruecolor(150, 150);
        imagecopyresampled($thumbnail, $original, 0, 0, 0, 0, 150, 150, $size[0], $size[1]);

        // Save thumbnail
        $result = null;

        switch ($mime)
        {
            case 'image/jpeg' : imagejpeg($thumbnail, $thumbnail_path); $result = $thumbnail_path; break;
            case 'image/png' : imagepng($thumbnail, $thumbnail_path); $result = $thumbnail_path; break;
            case 'image/gif' : imagegif($thumbnail, $thumbnail_path); $result = $thumbnail_path; break;
            case 'image/webp' : imagewebp($thumbnail, $thumbnail_path); $result = $thumbnail_path; break;
        }

        // Free memory
        imagedestroy($original); imagedestroy($thumbnail);

        return $result ? getURL($result) : null;
    }

    return getURL($thumbnail_path);
}

function css($file, array $params = array("path" => "url"))
{
    return asset("css", $file, $params);
}

function js($file, array $params = array("path" => "url"))
{
    return asset("javascript", $file, $params);
}

function download($file, array $params = array("path" => "url"))
{
    return asset("downloads", $file, $params);
}

function audio($file, array $params = array("path" => "url"))
{
    return asset("audio", $file, $params);
}

// ============================================================================================================== \\

function page($file)
{
    if (!file_exists("app/pages/$file") && !empty($files = glob("app/pages/$file*")))
    {
        return "app/pages/" . $files[0];
    }

    return "app/pages/$file";
}

function pageExists($page)
{
    // Make sure page is a php file
    $fileInfo = pathinfo($page);
    if ($fileInfo['extension'] !== "php")
    {
        $page .= ".php";
    }

    return file_exists("app" . DIRECTORY_SEPARATOR . "pages" . DIRECTORY_SEPARATOR . $page);
}

// ============================================================================================================== \\

function route($page = "")
{
    return BASE_URL . $page;
}

function getURL($page = "")
{
    return BASE_URL . $page;
}

// ============================================================================================================== \\

function redirect($target = null)
{
    // Redirect to given page
    if (isset($target))
    {
        header("Location: " . $target);
        exit;
    }

    // Redirect back to previous page
    if (isset($_SERVER["HTTP_REFERER"]))
    {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit;
    }

    // Refresh page
    header("Refresh:0");
    exit;
}

function redirectBack($fallback = null)
{
    // Redirect back to previous page
    if (isset($_SERVER["HTTP_REFERER"]))
    {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit;
    }

    // Redirect to fallback page
    if (isset($fallback))
    {
        header("Location: " . $fallback);
        exit;
    }

    // Refresh page
    header("Refresh:0");
    exit;
}

function refreshPage()
{
    header("Refresh:0");
    exit;
}

// ============================================================================================================== \\

function getCleanName($name)
{
    if (is_numeric($name[0]))
    {
        $name[0] = "_";
    }

    $name = str_replace(" ", "_", $name);
    return preg_replace('/[^a-zA-Z0-9_-]/', "", $name);
}

function getPureName($name)
{
    return preg_replace("/[^a-zA-Z]/", "", $name);
}

// ============================================================================================================== \\

function isEmptyObject($object)
{
    if ($object == null) { return true; }
    return ($object == new stdClass()) ? true : false;
}

// ============================================================================================================== \\
