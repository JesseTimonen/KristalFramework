<!doctype html>
<html lang="en">
    <head>
        
        <!-- Metadata -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="generator" content="Kristal Framework" />
        <?php if (isset($kristal_metadata[$page])): ?>
            <?php foreach ($kristal_metadata[$page] as $key => $value): ?>
                <meta property="<?= $key ?>" content="<?= $value ?>" />
            <?php endforeach; ?>
        <?php elseif (isset($kristal_metadata["*"])): ?>
            <?php foreach ($kristal_metadata["*"] as $key => $value): ?>
                <meta property="<?= $key ?>" content="<?= $value ?>" />
            <?php endforeach; ?>
        <?php endif; ?>


        <!-- Styles -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
        <?php if (isset($_SESSION["theme"])): ?>
            <link rel="stylesheet" type="text/css" href="<?= css($_SESSION["theme"] . ".css"); ?><?php if (AUTO_COMPILE_SCSS) {echo "?" . rand(); } ?>">
        <?php else: ?>
            <link rel="stylesheet" type="text/css" href="<?= css(((DEFAULT_THEME) ? DEFAULT_THEME : "main") . ".css"); ?><?php if (AUTO_COMPILE_SCSS) {echo "?" . rand(); } ?>">
        <?php endif; ?>

        
        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="<?= js("core.js"); ?>"></script>
        <script src="<?= js("main.js"); ?>"></script>


        <!-- Page Information -->
        <title><?= htmlspecialchars(isset($kristal_metadata[$page]->title) ? $kristal_metadata[$page]->title : (isset($kristal_metadata["*"]->title) ? $kristal_metadata["*"]->title : '')) ?></title>
        <link rel="icon" type="image/gif" href="<?= image("icon_website.png"); ?>" />


        <!-- Element to hold all PHP set JavaScript variables -->
        <script>function getVariable(key){ return $("#javascript-variables").attr(key); }</script>
        <div id="javascript-variables" style="display: none" baseURL="<?= BASE_URL ?>"></div>

    </head>
    <body>