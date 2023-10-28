<?php defined("ACCESS") or exit("Access Denied");

function debug($variable, $name = null)
{
    if (PRODUCTION_MODE) return;

    echo "<hr /><pre style='background-color: #f1f1f1; color: black; padding: 10px; border: 1px solid #black; border-radius: 5px; font-size: 14px;'>";

    if (isset($name)) echo "<strong>Debugging variable:</strong> $name<br><br>";
    echo var_export($variable, true);

    echo "</pre><hr />";
}
