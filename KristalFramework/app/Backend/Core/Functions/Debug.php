<?php defined("ACCESS") or exit("Access Denied");

function debug($variable, $name = null)
{
    if (PRODUCTION_MODE) return;

    echo "<hr /><pre style='background-color: #f8f9fa; padding: 10px; border: 1px solid #dee2e6; border-radius: 5px; font-size: 14px;'>";

    if (isset($name)) echo "<strong>Debugging variable:</strong> $name<br><br>";
    echo var_export($variable, true);

    echo "</pre><hr />";
}
