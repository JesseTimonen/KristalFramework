<!doctype html>
<html lang = "en">
    <head>
        <!-- Metadata -->
        <meta charset = "utf-8" />
        <meta name = "viewport" content = "width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name = "generator" content = "Kristal Framework" />
        <meta name = "robots" content = "noindex" />

        <!-- Styles -->
        <link rel = "stylesheet" href = "https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity = "sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin = "anonymous">
        <link rel = "stylesheet" type = "text/css" href = "<?= page("maintenance/maintenance.css"); ?>">
        <style>body { background-image: url("<?= image('backgrounds/maintenance.jpg'); ?>"); }</style>

        <!-- Scripts -->
        <script src = "https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity = "sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin = "anonymous"></script>
        <script src = "<?= page("maintenance/maintenance.js"); ?>"></script>
        <script src = "<?= js("core.js"); ?>"></script>

        <!-- Page Information -->
        <title><?php ts("maintenance"); ?></title>
        <link rel = "icon" type = "image/gif" href = "<?= image("icon_website.png"); ?>" />

        <!-- Element to hold all PHP set JavaScript variables -->
        <script>function getVariable(key){ return $("#javascript-variables").attr(key); }</script>
        <div id = "javascript-variables" style = "display: none"
            baseURL = "<?= BASE_URL ?>"
        ></div>
    </head>


    <body>
        <!-- language settings -->
        <div id = "language-selection">
            <label id = "fi-button" switchLanguage = "fi">FI</label>
            <label id = "en-button" switchLanguage = "en">EN</label>
        </div>

        <!-- Title -->
        <h1 class = "center" translationKey = "maintenance_title">Maintenance</h1>

        <!-- Description -->
        <div class = "container center" id = "notification">
            <p translationKey = "maintenance_description">We are currently maintaining our website, we will be back shortly. Thanks for your patience.</p>
        </div>

        <!-- Authentication -->
        <div class = "container center">
            <footer>
                <h2 translationKey = "maintenance_authentication">Authentication</h2>
                <form action = "" method = "post" role = "form">
                    <div class = "form-group">
                        <input type = "password" class = "form-control" name = "maintenance-password" id = "maintenance-password" translationKey = "maintenance_password" placeholder = "Password" required>
                    </div>
                    <button type = "submit" class = "btn btn-primary" translationKey = "maintenance_login">Sign In</button>
                    
                    <?php if ($authentication_failed) : ?>
                        <p id = "feedback" translationKey = "maintenance_authentication_failed" style = "color: red;">Failed to authenticate!</p>
                    <?php else: ?>
                        <p id = "feedback" style = "color: transparent;">.</p>
                    <?php endif; ?>
                </form>
            </footer>
        </div>

        <!-- Social links -->
        <div class = "social-icons center">
            <a href = "https://www.facebook.com" target = "_blank" data-toggle = "tooltip" title = "Facebook"><img border = "0" alt = "" src = "<?= image("logos/facebook.png"); ?>" width = "32" height = "32"></a>
            <a href = "https://www.twitter.com" target = "_blank" data-toggle = "tooltip" title = "Twitter"><img border = "0" alt = "" src = "<?= image("logos/twitter.png"); ?>" width = "40" height = "40"></a>
            <a href = "mailto:example.email@example.com" target = "_blank" data-toggle = "tooltip" title = "Email"><img border = "0" alt = "" src = "<?= image("logos/email.png"); ?>" width = "40" height = "40"></a>
            <a href = "https://www.youtube.com" target = "_blank" data-toggle = "tooltip" title = "Youtube"><img border = "0" alt = "" src = "<?= image("logos/youtube.png"); ?>" width = "40" height = "40"></a>
        </div>

    </body>
</html>