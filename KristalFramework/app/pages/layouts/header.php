<!doctype html>
<html lang = "en">
    <head>
        <!-- Metadata -->
        <meta charset = "utf-8" />
        <meta name = "viewport" content = "width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name = "generator" content = "Kristal Framework" />
        <?php if (isset($metadata[$page])): ?>
            <?php foreach ($metadata[$page] as $key => $value): ?>
                <meta property = "<?= $key ?>" content = "<?= $value ?>" />
            <?php endforeach; ?>
        <?php elseif (isset($metadata["*"])): ?>
            <?php foreach ($metadata["*"] as $key => $value): ?>
                <meta property = "<?= $key ?>" content = "<?= $value ?>" />
            <?php endforeach; ?>
        <?php endif; ?>

        <!-- Styles -->
        <link rel = "stylesheet" href = "https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity = "sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin = "anonymous">
        <?php if (isset($_SESSION["theme"])): ?>
            <link rel = "stylesheet" type = "text/css" href = "<?= css($_SESSION["theme"] . ".css"); ?><?php if (AUTO_COMPILE_SCSS) {echo "?" . rand(); } ?>">
        <?php else: ?>
            <link rel = "stylesheet" type = "text/css" href = "<?= css(((DEFAULT_THEME) ? DEFAULT_THEME : "main") . ".css"); ?><?php if (AUTO_COMPILE_SCSS) {echo "?" . rand(); } ?>">
        <?php endif; ?>

        <!-- Scripts -->
        <script src = "https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity = "sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin = "anonymous"></script>
        <script src = "<?= js("core.js"); ?>"></script>
        <script src = "<?= js("main.js"); ?>"></script>

        <!-- Page Information -->
        <title><?php if (isset($metadata[$page]->title)) { echo $metadata[$page]->title; } else if (isset($metadata["*"]->title)) { echo $metadata["*"]->title; } ?></title>
        <link rel = "icon" type = "image/gif" href = "<?= image("icon_website.png"); ?>" />

        <!-- Element to hold all PHP set JavaScript variables -->
        <script>function getVariable(key){ return $("#javascript-variables").attr(key); }</script>
        <div id = "javascript-variables" style = "display: none" baseURL = "<?= BASE_URL ?>"></div>
    </head>
    <body>