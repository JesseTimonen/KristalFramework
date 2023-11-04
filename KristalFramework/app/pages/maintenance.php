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
        <link rel="stylesheet" type="text/css" href="<?= css("maintenance.css"); ?>">
        <style>body { background-image: url("<?= image('Backgrounds/maintenance.jpg'); ?>"); }</style>

        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="<?= js("core.js"); ?>"></script>
        <script src="<?= js("maintenance.js"); ?>"></script>

        <!-- Page title -->
        <title><?= translate("maintenance"); ?></title>

        <!-- Website icon -->
        <link rel="icon" type="image/gif" href="<?= image("kristal_framework_alt_icon.png"); ?>" />
    </head>


    <body>
        
        <!-- language settings -->
        <div id="language-selection">
            <img src="<?= image("Flags/fi.jpg"); ?>" id="fi-button" class="select-language" switchLanguage="fi" />
            <img src="<?= image("Flags/en.jpg"); ?>" id="en-button" class="select-language" switchLanguage="en" />
        </div>


        <!-- Title -->
        <div class="container maintenance-title">
            <h1 class="maintenance-title" translationKey="maintenance_title">Maintenance</h1>
        </div>

        
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

                <?php if ($kristal_authentication_attempt_limit_reached) : ?>
                    <p id="feedback" style="color: red;">
                        <span translationKey="maintenance_authentication_timeout_1">Too many login attempts, please wait </span>
                        <span><?=$kristal_authentication_lockout_duration; ?></span>
                        <span translationKey="maintenance_authentication_timeout_2"> before you can try again.</span>
                    </p>
                <?php elseif ($kristal_authentication_failed) : ?>
                    <p id="feedback" style="color: red;" translationKey="maintenance_authentication_failed">Failed to authenticate!</p>
                <?php else: ?>
                    <p id="feedback" style="padding: 12px;"></p>
                <?php endif; ?>
            </form>
        </div>

        
        <!-- Social links -->
        <div class="social-icons">
            <!-- Email -->
            <a class="social-menu-link" href="mailto:example@example.com" target="_blank" data-bs-toggle="tooltip" tooltipTranslationKey="maintenance_email" data-bs-title="Email">
                <img class="social-menu-image" src="<?= image("Icons/email.png") ?>">
            </a>

            <!-- Twitter -->
            <a class="social-menu-link" href="https://twitter.com" target="_blank" data-bs-toggle="tooltip" data-bs-title="Twitter">
                <img class="social-menu-image" src="<?= image("Icons/twitter.png") ?>">
            </a>

            <!-- Facebook -->
            <a class="social-menu-link" href="https://facebook.com" target="_blank" data-bs-toggle="tooltip" data-bs-title="Facebook">
                <img class="social-menu-image" src="<?= image("Icons/facebook.png") ?>">
            </a>

            <!-- Youtube -->
            <a class="social-menu-link" href="https://youtube.com" target="_blank" data-bs-toggle="tooltip" data-bs-title="Youtube">
                <img class="social-menu-image" src="<?= image("Icons/youtube.png") ?>">
            </a>
        </div>

    </body>
</html>