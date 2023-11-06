<?php include "Partials/navigation.php"; ?>

<?php
/** Available variables:
 * - $theme_feedback
 */
?>


<!-- Title -->
<div class="container main-content">
    <h1 translationKey="demo_page_title">Kristal Framework Demo Page</h1>
    <p  translationKey="demo_page_description">This page showcases a wide array of the framework's demo features. Explore the numerous possibilities at your disposal</p>
</div>


<!-- Theme -->
<div class="container main-content">
    
    <h1 translationKey="theme_title">Theme</h1>
    <p translationKey="theme_description">The active theme is integrated within the HTML header template found at 'App/Pages/Base/'. This header utilizes the theme stored in the active session, defaulting to the preset theme in the config.php file if none is specified. You can modify the theme using a form that initiates a request to alter it. This request is then relayed to a controller that updates the session with the new theme.</p>

    <p><?php if (!empty($theme_feedback)) echo $theme_feedback; ?></p>

    <div class="theme-selection-div">
        <form action='<?= route("demo"); ?>' method='post'>
            <?php CSRF::create("change_theme_form"); ?>
            <?php CSRF::request("change_theme"); ?>
            <input type='hidden' name='theme' value='dark'>
            <input type='submit' class='btn btn-dark' translationKey='activate_dark_button' value='Activate Dark Theme'>
        </form>

        <form action='<?= route("demo"); ?>' method='post'>
            <?php CSRF::create("change_theme_form"); ?>
            <?php CSRF::request("change_theme"); ?>
            <input type='hidden' name='theme' value='light'>
            <input type='submit' class='btn btn-light' translationKey='activate_light_button' value='Activate Light Theme'>
        </form>
    </div>
</div>