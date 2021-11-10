<?php include "layouts/navigation.php"; ?>

<div class = "container center">
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