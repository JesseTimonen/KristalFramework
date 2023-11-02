<nav class="navbar navbar-expand-lg border-bottom">
    <div class="container">

        <!-- Navbar Title (text) -->
        <!-- <a class="navbar-brand" href="<?= route(""); ?>" translationKey="nav_title">Kristal Framework</a> -->

        <!-- Navbar Title (image) -->
        <a class="navbar-brand" href="<?= route(""); ?>"><img class="navbar-logo colorized-fast" src="<?= image("kristal_framework_logo.png"); ?>" /></a>

        <!-- Navbar mobile toggle button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation" data-bs-theme="dark">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar-menu">

            <!-- Navbar links -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" page="home.php" href="<?= route(""); ?>" translationKey="nav_home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" page="theme.php" href="<?= route("theme"); ?>" translationKey="nav_theme">Change Theme</a>
                </li>
            </ul>
      
            <!-- Language settings -->
            <ul class="language-menu navbar-nav justify-content-end">
                <!-- Language menu (text) -->
                <!-- <li class="nav-item"><a id="fi-button" class="nav-link select-language" switchLanguage="fi">FI</a></li> -->
                <!-- <li class="nav-item"><a id="en-button" class="nav-link select-language" switchLanguage="en">EN</a></li> -->

                <!-- Language menu (flags) -->
                <li class="nav-item"><img src="<?= image("Flags/fi.jpg"); ?>" id="fi-button" class="select-language" switchLanguage="fi" /></li>
                <li class="nav-item"><img src="<?= image("Flags/en.jpg"); ?>" id="en-button" class="select-language" switchLanguage="en" /></li>
            </ul>
     
        </div>
    </div>
</nav>


<!-- Activate correct navigation link -->
<!-- (add page attribute to your navigation links with page file name as it's value, for example page="home.php") -->
<script>$("[page='<?= $page ?>']").addClass("active");</script>