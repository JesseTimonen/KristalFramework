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
                    <a class="nav-link" page="demo.php" href="<?= route(translate("route_demo")); ?>" translationKey="nav_demo">Demo</a>
                </li>
            </ul>

            <!-- Language settings -->
            <ul class="language-menu navbar-nav justify-content-end">
                <li class="nav-item">
                    <form method='post'>
                        <?php CSRF::create("change_language_form"); ?>
                        <?php CSRF::request("change_language"); ?>
                        <button type='submit' name='language' value='fi' class='btn btn-link p-0 border-0 bg-transparent'>
                            <img src="<?= image("Flags/fi.jpg"); ?>" class="change-language<?php if(Session::get("language") === "fi") echo " active"; ?>" />
                        </button>
                    </form>
                </li>
                <li class="nav-item">
                    <form method='post'>
                        <?php CSRF::create("change_language_form"); ?>
                        <?php CSRF::request("change_language"); ?>
          
                        <button type='submit' name='language' value='en' class='btn btn-link p-0 border-0 bg-transparent'>
                            <img src="<?= image("Flags/en.jpg"); ?>" class="change-language<?php if(Session::get("language") === "en") echo " active"; ?>" />
                        </button>
                    </form>
                </li>
            </ul>

        </div>
    </div>
</nav>


<!-- Activate correct navigation link -->
<!-- (add page attribute to your navigation links with page file name as it's value, for example page="home.php") -->
<script>$("[page='<?= $page ?>']").addClass("active");</script>