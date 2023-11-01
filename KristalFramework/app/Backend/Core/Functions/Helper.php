<?php defined("ACCESS") or exit("Access Denied");


function kristal_getAssetPath($folder, $file, array $params = ["path" => "url"])
{
    $filePath = "App/Public/" . $folder . "/" . $file;

    // Validate the "path" parameter
    $path_type = strtolower($params["path"] ?? "url");

    if (!in_array($path_type, ["url", "path"], true))
    {
        throw new Exception("Invalid path parameter passed to " . $folder . "() method. It should be either 'url' or 'path'");
    }

    // Handle glob matching
    if (!file_exists($filePath))
    {
        $files = glob($filePath . "*");

        if (!empty($files))
        {
            $filePath = $files[0];
        }
        else
        {
            return "";
        }
    }

    // Determine the return path type
    return $path_type === "url" ? BASE_URL . $filePath : $filePath;
}

// ============================================================================================================== \\

function image($file, array $params = ["path" => "url"]): string
{
    return kristal_getAssetPath("images", $file, $params);
}

function css($file, array $params = ["path" => "url"]): string
{
    return kristal_getAssetPath("css", $file, $params);
}

function js($file, array $params = ["path" => "url"]): string
{
    return kristal_getAssetPath("javascript", $file, $params);
}

function download($file, array $params = ["path" => "url"]): string
{
    return kristal_getAssetPath("downloads", $file, $params);
}

function audio($file, array $params = ["path" => "url"]): string
{
    return kristal_getAssetPath("audio", $file, $params);
}

function thumbnail($file_path, array $params = array("path" => "url"))
{
    $thumbnail_path = str_replace("App/Public/Images/", "", $file_path);
    $thumbnail_path = str_replace("/", "-", $thumbnail_path);
    $thumbnail_path = "App/Backend/Core/Thumbnails/" . $thumbnail_path;

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

// ============================================================================================================== \\

function page($file)
{
    if (!file_exists("App/Pages/$file") && !empty($files = glob("App/Pages/$file*")))
    {
        return "App/Pages/" . $files[0];
    }

    return "App/Pages/$file";
}

function pageExists($page)
{
    // Make sure page is a php file
    $file_info = pathinfo($page);
    if ($file_info['extension'] !== "php")
    {
        $page .= ".php";
    }

    return file_exists("App/Pages/" . $page);
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
