<?php include "Partials/navigation.php"; ?>


<div class="container">

    <h1 translationKey="change_theme">Change Theme</h1>

    <br><br>

    <p><?php if (!empty($message)) echo $message; ?></p>

    <div class="row">
        <div class="col-md-12">

            <form action='<?= route("theme"); ?>' method='post' role='form'>
                <?= csrf("change_theme_form"); ?>
                <?= request("change_theme"); ?>
                <input type='hidden' name='theme' value='dark'>
                <input type='submit' class='btn btn-dark' translationKey='activate_dark_button' value='Activate Dark Theme'>
            </form>

            <br>

            <form action='<?= route("theme"); ?>' method='post' role='form'>
                <?= csrf("change_theme_form"); ?>
                <?= request("change_theme"); ?>
                <input type='hidden' name='theme' value='light'>
                <input type='submit' class='btn btn-light' translationKey='activate_light_button' value='Activate Light Theme'>
            </form>

        </div>
    </div>
</div>