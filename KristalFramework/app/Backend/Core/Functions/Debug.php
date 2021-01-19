<?php defined("ACCESS") or exit("Access Denied");

function debug($variable, $name = null)
{
    echo "<hr /><pre>";

    if (isset($name)) echo "Debugging variable: $name<br><br>";
    echo var_export($variable, true);

    echo "</pre><hr />";
}