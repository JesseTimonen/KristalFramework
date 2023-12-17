<?php include "Partials/navigation.php"; ?>

<?php
/** Available variables:
 * - $feedback
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
    <p translationKey="">Chaning theme using form requests:</p>

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

    <p translationKey="">Chaning theme using links:</p>
    <p><a href="<?= route("demo/dark"); ?>">Activate dark theme</a></p>
    <p><a href="<?= route("demo/light"); ?>">Activate light theme</a></p>

    <?php if (!empty($feedback)): ?>
        <p><?= $feedback; ?></p>
    <?php endif; ?>
</div>
