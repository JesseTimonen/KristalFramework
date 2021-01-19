<?php defined("ACCESS") or exit("Access Denied");

/*=======================================================================================================================*\
Example Call

<?php Form::createThemeOption("dark"); ?>
\*=======================================================================================================================*/

class Form
{
    public static function createThemeOption($value)
    {
        echo "<form action = '" . BASE_URL . "theme' method = 'post' role = 'form'>";
            csrf("change_theme_form");
            request("change_theme");
            echo "<input type = 'hidden' name = 'theme' value = '$value'>";
            echo "<input type = 'submit' class = 'btn btn-$value' translationKey = '$value' value = '$value'>";
        echo "</form>";
    }
}