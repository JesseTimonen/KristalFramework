<!doctype html>
<html lang="en">
    <head>
        <!-- Metadata -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="generator" content="Kristal Framework" />
        <meta name="robots" content="noindex" />

        <!-- Styles -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?= page("maintenance/maintenance.css"); ?>">
        <style>body { background-image: url("<?= image('backgrounds/maintenance.jpg'); ?>"); }</style>

        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="<?= js("core.js"); ?>"></script>
        <script src="<?= page("maintenance/maintenance.js"); ?>"></script>

        <!-- Page Information -->
        <title><?= translate("maintenance"); ?></title>
        <link rel="icon" type="image/gif" href="<?= image("icon_website.png"); ?>" />

        <!-- Element to hold all PHP set JavaScript variables -->
        <script>function getVariable(key){ return $("#javascript-variables").attr(key); }</script>
        <div id="javascript-variables" style="display: none" baseURL="<?= BASE_URL ?>"></div>
    </head>


    <body>
        <!-- language settings -->
        <div id="language-selection">
            <label id="fi-button" switchLanguage="fi">FI</label>
            <label id="en-button" switchLanguage="en">EN</label>
        </div>


        <!-- Title -->
        <h1 class="maintenance-title" translationKey="maintenance_title">Maintenance</h1>


        <!-- Description -->
        <div class="container maintenance-text">
            <p translationKey="maintenance_description">We are currently maintaining our website, we will be back shortly. Thanks for your patience.</p>
        </div>


        <!-- Authentication -->
        <div class="container authentication-container">
            <h2 translationKey="maintenance_authentication">Authentication</h2>
            <form action="" method="post" role="form">

                <div class="mb-3">
                    <input type="password" class="form-control" name="maintenance-password" id="maintenance-password" translationKey="maintenance_password" placeholder="Password" required>
                </div>

                <button type="submit" class="btn btn-primary" translationKey="maintenance_login">Sign In</button>
                    
                <?php if ($authentication_failed) : ?>
                    <p id="feedback" translationKey="maintenance_authentication_failed" style="color: red;">Failed to authenticate!</p>
                <?php else: ?>
                    <p id="feedback" style="color: transparent;">.</p>
                <?php endif; ?>
            </form>
        </div>

        <!-- Social links -->
        <div class="social-icons">
            <!-- Email -->
            <a class="social-menu-link" href="mailto:example@example.com" target="_blank" data-bs-toggle="tooltip" tooltipTranslationKey="maintenance_email" data-bs-title="Email">
                <img class="social-menu-image" src="<?= image("icons/email.png") ?>">
            </a>

            <!-- Twitter -->
            <a class="social-menu-link" href="https://twitter.com" target="_blank" data-bs-toggle="tooltip" data-bs-title="Twitter">
                <img class="social-menu-image" src="<?= image("icons/twitter.png") ?>">
            </a>

            <!-- Facebook -->
            <a class="social-menu-link" href="https://facebook.com" target="_blank" data-bs-toggle="tooltip" data-bs-title="Facebook">
                <img class="social-menu-image" src="<?= image("icons/facebook.png") ?>">
            </a>

            <!-- Youtube -->
            <a class="social-menu-link" href="https://youtube.com" target="_blank" data-bs-toggle="tooltip" data-bs-title="Youtube">
                <img class="social-menu-image" src="<?= image("icons/youtube.png") ?>">
            </a>
        </div>

    </body>
</html>