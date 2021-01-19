<nav class = "navbar navbar-expand-lg fixed-top navbar-bg-custom navbar-dark">
    <!-- Navbar title -->
    <a href = "#" class = "navbar-brand" translationKey = "navbar_title">Kristal Framework</a>

    <!-- Navbar collapse button -->
    <button class = "navbar-toggler" type = "button" data-toggle = "collapse" data-target = "#collapsible-navbar">
        <span class = "navbar-toggler-icon"></span>
    </button>

    <!-- Navigation -->
    <div class = "collapse navbar-collapse" id = "collapsible-navbar">

        <!-- Links -->
        <ul class = "navbar-nav mr-auto" id = "navbar-links">
            <li class = "nav-item"><a class = "nav-link" page = "home.php" href = "<?= getURL(""); ?>" translationKey = "nav_home"></a></li>
            <li class = "nav-item"><a class = "nav-link" page = "about.php" href = "<?= getURL("about") ?>" translationKey = "nav_about"></a></li>
            <li class = "nav-item"><a class = "nav-link" page = "theme.php" href = "<?= getURL("theme") ?>" translationKey = "nav_theme"></a></li>
            <li class = "nav-item"><a class = "nav-link" page = "mail.php" href = "<?= getURL("mail") ?>" translationKey = "nav_mail"></a></li>
        </ul>

        <!-- language settings -->
        <ul class = "navbar-nav ml-auto nav-flex-icons">
            <li class = "nav-item" id = "fi-button"><a class = "nav-link select-language" switchLanguage = "fi">FI</a></li>
            <li class = "nav-item" id = "en-button"><a class = "nav-link select-language" switchLanguage = "en">EN</a></li>
        </ul>
    </div>
</nav>

<!-- Activate correct navigation link -->
<script>$("[page='<?= $page ?>']").addClass("active");</script>