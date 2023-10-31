<?php namespace Backend\Core;
defined("ACCESS") or exit("Access Denied");


class PHPJS
{
    public static function addJSVariable($variable, $value = "")
    {
        self::generateScript(function() use ($variable, $value)
        {
            if (is_array($variable))
            {
                foreach ($variable as $key => $val)
                {
                    echo "document.getElementById('javascript-variables').setAttribute('$key', '$val');";
                }
            }
            else
            {
                echo "document.getElementById('javascript-variables').setAttribute('$variable', '$value');";
            }
        });
    }


    public static function script($script)
    {
        self::generateScript(function() use ($script)
        {
            echo $script;
        });
    }


    private static function generateScript($callback)
    {
        ?>
        <script>
            window.addEventListener("DOMContentLoaded", function() {<?php $callback(); ?>});
        </script>
        <?php
    }
}