<?php namespace Backend\Core;
defined("ACCESS") or exit("Access Denied");

use Patchwork\JSqueeze;


final class JS_Compiler
{
    public static function compile()
    {
        $compiler = new JSqueeze();
        $js_bundles = unserialize(JS_BUNDLES);

        foreach ($js_bundles as $container => $files)
        {
            // Add date to generated JavaScript
            $js = (PRINT_COMPILE_DATE_JS) ? "/* Generated at: " . date(DATE_FORMAT . " " . TIME_FORMAT) . " */\n" : "";

            foreach ($files as $file)
            {
                // Make sure file is a JavaScript file
                if (substr($file, -3) !== ".js")
                {
                    $file .= ".js";
                }

                // Compile JavaScript
                if (file_exists("app/public/javascript/" . $file))
                {
                    $js .= $compiler->squeeze(
                        file_get_contents("app/public/javascript/" . $file),
                        true,   // $singleLine
                        true,   // $keepImportantComments
                        false   // $specialVarRx
                    );
                }
                else
                {
                    $js .= "console.warn('File app/public/javascript/$file was not found when compiling javascript!');";
                }
            }

            // Make sure file is a JavaScript file
            if (substr($container, -3) !== ".js")
            {
                $container .= ".js";
            }

            // Write compiled files
            file_put_contents("app/public/javascript/" . $container, $js);
        }
    }
}