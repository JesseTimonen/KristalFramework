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
            $should_compile = false;

            // Make sure containers get .js file extension
            if (substr($container, -3) !== ".js")
            {
                $container .= ".js";
            }

            $compiled_file_path = "app/public/javascript/" . $container;
            $compiled_file_mtime = file_exists($compiled_file_path) ? filemtime($compiled_file_path) : 0;

            foreach ($files as $file)
            {
                // Make sure file is a JavaScript file
                if (substr($file, -3) !== ".js")
                {
                    $file .= ".js";
                }

                // Check is any js file updated since last JS compile
                $file_path = "app/public/javascript/" . $file;
                if (file_exists($file_path) && filemtime($file_path) > $compiled_file_mtime)
                {
                    $should_compile = true;
                    break;
                }
            }

            if ($should_compile)
            {
                $compiled_js = "";

                foreach ($files as $file)
                {
                    // Make sure file is a JavaScript file
                    if (substr($file, -3) !== ".js")
                    {
                        $file .= ".js";
                    }

                    $path = "app/public/javascript/" . $file;
                    $js = file_get_contents($path);
                    $compiled_js .= $compiler->squeeze($js,
                        true,   // $singleLine
                        true,   // $keepImportantComments
                        false   // $specialVarRx
                    );
                }

                // Add date to generated JavaScript
                if (PRINT_COMPILE_DATE_JS) {
                    $compiled_js .= "\n\n\n/* Generated at: " . date(DATE_FORMAT . " " . TIME_FORMAT) . " */";
                }

                file_put_contents($compiled_file_path, $compiled_js);
            }
        }
    }
}