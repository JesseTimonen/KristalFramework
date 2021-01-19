<?php defined("ACCESS") or exit("Access Denied");


function asset($folder, $file, array $params = array("path" => "url"))
{
    if (strtolower($is_url) === "relative")
    {
        $is_url = false;
    }
    else if (strtolower($is_url) === "url")
    {
        $is_url = true;
    }
    
    // Find files using only its name
    if (!file_exists("app/public/$folder/$file") && !empty($files = glob("app/public/$folder/$file*")))
    {
        if ($params["type"] == "url")
        {
            return BASE_URL . $files[0];
        }
        else
        {
            return $files[0];
        }
    }

    // Return file normally
    if ($params["type"] == "url")
    {
        return BASE_URL . "app/public/$folder/$file";
    }
    else
    {
        return "app/public/$folder/$file";
    }
}

// ============================================================================================================== \\

function image($file, array $params = array("path" => "url"))
{
    return asset("images", $file, $params);
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

function subpage($file)
{
    if (!file_exists("app/pages/subpages/$file") && !empty($files = glob("app/pages/subpages/$file*")))
    {
        return "app/pages/subpages/" . $files[0];
    }

    return "app/pages/subpages/$file";
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