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
            $container = self::ensureJsExtension($container);
            $compiled_file_path = "app" . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR . "javascript" . DIRECTORY_SEPARATOR . $container;
            $compiled_file_mtime = file_exists($compiled_file_path) ? filemtime($compiled_file_path) : 0;

            $should_compile = false;

            foreach ($files as $file)
            {
                // Check is any js file updated since last JS compile
                $file = self::ensureJsExtension($file);
                $file_path = "app" . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR . "javascript" . DIRECTORY_SEPARATOR . $file;
                 
                // Check is any js file updated since last JS compile
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
                    $file = self::ensureJsExtension($file);
                    $path = "app" . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR . "javascript" . DIRECTORY_SEPARATOR . $file;
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

    
    private static function ensureJsExtension($filename)
    {
        return substr($filename, -3) !== '.js' ? $filename . '.js' : $filename;
    }
}