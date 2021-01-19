<?php include "templates/navigation.php"; ?>

<div class = "main container center">
    <h1 translationKey = "change_theme">Change Theme</h1>
    <br><br>

    <div class = "row">
        <div class = "col-md-6 large-right">
            <!-- Call form block to create theme option -->
            <?php Form::createThemeOption("dark"); ?>
        </div>

        <div class = "col-md-6 large-left">
            <!-- Call form block to create theme option -->
            <?php Form::createThemeOption("light"); ?>
        </div>
    </div>
</div>

<!-- Theme change feedback -->
<p class = "center" style = "padding: 30px;">
    <?php if ($theme_change_success): ?>
        <?php ts("change_theme", $theme); ?>
    <?php endif; ?>
</p>