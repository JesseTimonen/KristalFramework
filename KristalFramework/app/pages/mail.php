<?php include "layouts/navigation.php"; ?>

<div class = "container center">
    <h1 translationKey = "send_mail">Send example mail</h1>
    <br><br>

    <form action = "" method = "post" role = "form">
        <?php csrf("mail_form"); ?>
        <?php request("send_mail"); ?>
        <div class = "form-group">
            <input type = "email" class = "form-control" name = "receiver" id = "receiver" translationKey = "receiver" placeholder = "Receiver's Email" required>
            <br/>
            <label class = "danger" translationKey = "mail_warning">Notice! Sending email without correct email configurations will result a PHP error.</label>
        </div>
        <button type = "submit" class = "btn btn-primary" translationKey = "send">Send</button>
    </form>
</div>