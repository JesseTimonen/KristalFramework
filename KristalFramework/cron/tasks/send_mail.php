<?php defined("ACCESS") or exit("Access Denied");

use Backend\Core\Mailer;

class Task
{
    private $mailer;

    public function __construct()
    {
        // $this->mailer = new Mailer();

        // $result = $this->mailer->send(
        //     "example.email@example.com",
        //     translate("example_email_title"),
        //     getLanguage() . "/welcome.php",
        //     array(
        //         "name" => "user",
        //     )
        // );
    }
}

new Task();