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
        <link rel = "stylesheet" href = "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity = "sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin = "anonymous">
        <?php if (isset($_SESSION["theme"])): ?>
            <link rel = "stylesheet" type = "text/css" href = "<?= css($_SESSION["theme"] . ".css"); ?><?php if (AUTO_COMPILE_SCSS) {echo "?" . rand(); } ?>">
        <?php else: ?>
            <link rel = "stylesheet" type = "text/css" href = "<?= css(((DEFAULT_THEME) ? DEFAULT_THEME : "main") . ".css"); ?><?php if (AUTO_COMPILE_SCSS) {echo "?" . rand(); } ?>">
        <?php endif; ?>

        <!-- Scripts -->
        <script src = "https://code.jquery.com/jquery-3.4.1.min.js" integrity = "sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin = "anonymous"></script>
        <script src = "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity = "sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin = "anonymous"></script>
        <script src = "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity = "sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin = "anonymous"></script>
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