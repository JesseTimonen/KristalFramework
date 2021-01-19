<?php namespace Backend\Core;
defined("ACCESS") or exit("Access Denied");


class PHPJS
{
    public static function addJSVariable($variable, $value = "")
    {
        if (is_array($variable))
        {
            ?>
            <script>
                window.addEventListener("load", function() {
                    <?php foreach($variable as $key => $value): ?>
                        document.getElementById("javascript-variables").setAttribute("<?= $key ?>", "<?= $value ?>");
                    <?php endforeach; ?>
                });
            </script>
            <?php
        }
        else
        {
            ?>
            <script>
                window.addEventListener("load", function() {
                    document.getElementById("javascript-variables").setAttribute("<?= $variable ?>", "<?= $value ?>");
                });
            </script>
            <?php
        }
    }


    public static function script($script)
    {
        ?>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                <?= $script ?>
            });
        </script>
        <?php
    }
}