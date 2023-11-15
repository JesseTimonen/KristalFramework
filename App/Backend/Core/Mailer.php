<?php namespace Backend\Core;
defined("ACCESS") or exit("Access Denied");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    private $mailer;
    private static $email_template_path = "App/Public/Emails/";


    public function __construct()
    {
        try
        {
            $this->mailer = new PHPMailer(true);
            $this->mailer->isSMTP();
            $this->mailer->isHTML(true);
            $this->mailer->SMTPAuth = true;
            $this->mailer->CharSet = "UTF-8";
            $this->mailer->SMTPSecure = MAILER_PROTOCOL;
            $this->mailer->Port = MAILER_PORT;
            $this->mailer->Host = MAILER_HOST;
            $this->mailer->Username = MAILER_EMAIL;
            $this->mailer->Password = MAILER_PASSWORD;
            $this->mailer->setFrom(MAILER_EMAIL, MAILER_NAME);
        }
        catch (Exception)
        {
            throw new Exception("Fatal Mailer Error! " . $e->getMessage());
        }
    }

    
    public function send($receivers, $title, $content, array $variables = null)
    {
        try
        {
            if (is_array($receivers))
            {
                foreach ($receivers as $receiver)
                {
                    $this->mailer->addAddress($receiver);
                }
            }
            else
            {
                $this->mailer->addAddress($receivers);
            }

            // Make sure email content is in php form
            $content = ensurePHPExtension($content);
            
            // Get email template
            $email = file_get_contents(self::$email_template_path . $content);

            // Include variables passed to email
            if (!empty($variables))
            {
                $search = [];
                $replace = [];
                foreach ($variables as $key => $value)
                {
                    $search[] = "{{ $key }}";
                    $replace[] = $value;
                }
                $email = str_replace($search, $replace, $email);
            }

            // Send mail
            $this->mailer->Subject = $title;
            $this->mailer->Body = $email;
            $this->mailer->send();
            
            // Clear recipients for next send
            $this->mailer->clearAddresses();
            return true;
        }
        catch (Exception)
        {
            throw new Exception("Fatal Mailer Error!");
        }
    }
}