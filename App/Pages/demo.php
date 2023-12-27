<?php include "Partials/navigation.php"; ?>


<?php
/** Available variables:
 * - $feedback
 */
?>


<!-- Title -->
<div class="container main-content">
    <h1><?= translate("Kristal Framework Demo Page"); ?></h1>
    <p><?= translate("This page showcases a wide array of the framework's demo features. Explore the numerous possibilities at your disposal."); ?></p>
</div>


<!-- Theme -->
<div class="container main-content">
    
    <h1><?= translate("Theme"); ?></h1>
    <p><?= translate("Chaning theme using form requests"); ?>:</p>

    <div class="theme-selection-div">
        <form action='<?= route(strtolower(translate("Demo"))); ?>' method='post'>
            <?php CSRF::create("change_theme_form"); ?>
            <?php CSRF::request("change_theme"); ?>
            <input type='hidden' name='theme' value='dark'>
            <input type='submit' class='btn btn-dark' value='<?= translate("Activate dark theme"); ?>'>
        </form>

        <form action='<?= route(strtolower(translate("Demo"))); ?>' method='post'>
            <?php CSRF::create("change_theme_form"); ?>
            <?php CSRF::request("change_theme"); ?>
            <input type='hidden' name='theme' value='light'>
            <input type='submit' class='btn btn-light' value='<?= translate("Activate light theme"); ?>'>
        </form>
    </div>

    <p><?= translate("Chaning theme using links"); ?>:</p>
    <p><a href="<?= route("demo/dark"); ?>"><?= translate("Activate dark theme"); ?></a></p>
    <p><a href="<?= route("demo/light"); ?>"><?= translate("Activate light theme"); ?></a></p>

    <?php if (!empty($feedback)): ?>
        <p><?= $feedback; ?></p>
    <?php endif; ?>


    <!-- Countdown Block -->
    <?php Block::render("countdown", [
        "date" => "1.1.2024 00:00:00",
        "format" => "⏰ {d} {D} {h}:{m}:{s} ⏰",
        "days" => "days|day",
        "hours" => "h",
        "minutes" => "m",
        "seconds" => "s",
        "expired" => "⏰ 00:00:00 ⏰",
    ]); ?>


    <!-- Emails -->
    <form method="post">
        <?php CSRF::create("send_email"); ?>
        <?php CSRF::request("send_email"); ?>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="receiver" id="receiver">
        </div>

        <div class="form-group">
            <label for="email">Title</label>
            <input type="text" class="form-control" name="title" id="title">
        </div>

        <div class="form-group">
            <label for="comment">Message</label>
            <textarea rows="5" class="form-control" name="message" id="message"></textarea>
        </div>

        <div class="form-group center">
            <input type="submit" class="btn btn-primary" value="Send Email">
        </div>

        <div id="send-email-feedback"></div><br/>
    </form>


</div>
