<?php namespace Backend\Core;
defined("ACCESS") or exit("Access Denied");

use ScssPhp\ScssPhp\Compiler;


final class SCSS_Compiler
{
    private static $themes_folder_path = "app" . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR . "css" . DIRECTORY_SEPARATOR . "themes" . DIRECTORY_SEPARATOR . "*.scss";
    private static $scss_folder_path = "app" . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR . "css" . DIRECTORY_SEPARATOR . "scss" . DIRECTORY_SEPARATOR . "*.scss";
    private static $compiled_css_folder_path = "app" . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR . "css" . DIRECTORY_SEPARATOR;
    private static $core_scss_folder_path = "app" . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR . "css" . DIRECTORY_SEPARATOR . "core" . DIRECTORY_SEPARATOR . "*.scss";


    public static function compile()
    {
        $compiler = new Compiler();

        // Select formatter
        
        switch (strtolower(COMPILED_CSS_TYPE))
        {
            case "expanded": $compiler->setOutputStyle("expanded"); break;
            case "compressed": $compiler->setOutputStyle("compressed"); break;
            default: $compiler->setOutputStyle("compressed"); break;
        }

        if (empty(glob(self::$themes_folder_path)))
        {
            if (self::shouldCompileWithoutTheme())
            {
                self::compileWithoutTheme($compiler);
            }
        }
        else
        {
            if (self::shouldCompileWithTheme())
            {
                self::compileWithTheme($compiler);
            }
        }
    }


    private static function shouldCompileWithoutTheme()
    {
        $compiled_file_mtime = file_exists(self::$compiled_css_folder_path . DEFAULT_THEME . ".css") ? filemtime(self::$compiled_css_folder_path . DEFAULT_THEME . ".css") : 0;

        foreach (glob(self::$scss_folder_path) as $element)
        {
            if (filemtime($element) > $compiled_file_mtime)
            {
                return true;
            }
        }

        foreach (glob(self::$core_scss_folder_path) as $element)
        {
            if (filemtime($element) > $compiled_file_mtime)
            {
                return true;
            }
        }

        return false;
    }


    private static function shouldCompileWithTheme()
    {
        foreach (glob(self::$themes_folder_path) as $theme)
        {
            $theme_name = str_replace(".scss", "", basename($theme));

            if (filemtime($theme) > filemtime(self::$compiled_css_folder_path . $theme_name . ".css"))
            {
                return true;
            }

            foreach (glob(self::$scss_folder_path) as $scss_file)
            {
                if (filemtime($scss_file) > filemtime(self::$compiled_css_folder_path . $theme_name . ".css"))
                {
                    return true;
                }
            }

            foreach (glob(self::$core_scss_folder_path) as $core_scss_file)
            {
                if (filemtime($core_scss_file) > filemtime(self::$compiled_css_folder_path . $theme_name . ".css"))
                {
                    return true;
                }
            }
        }

        return false;
    }

    
    private static function compileWithoutTheme($compiler)
    {
        $scss = "";

        // Add together all core scss files
        foreach (glob(self::$core_scss_folder_path) as $file)
        {
            $scss .= file_get_contents($file);
        }

        // Add together all scss files
        foreach (glob(self::$scss_folder_path) as $file)
        {
            $scss .= file_get_contents($file);
        }
    
        // Compile sass files
        $compiled_css = $compiler->compile($scss);

        // Add comment when file was last modified
        if (PRINT_COMPILE_DATE_CSS) {
            $compiled_css .= "\n\n\n/* Generated at: " . date(DATE_FORMAT . " " . TIME_FORMAT) . " */";
        }

        // Create css files from compiled sass
        file_put_contents(self::$compiled_css_folder_path . DEFAULT_THEME . ".css", $compiled_css);
    }

    
    private static function compileWithTheme($compiler)
    {
        $scss = "";
        
        // Go through all themes and generate their css
        foreach (glob(self::$themes_folder_path) as $theme)
        {
            // Get theme name
            $theme_name = str_replace(".scss", "", basename($theme));

            // Add theme variables
            $scss .= file_get_contents($theme);

            // Add together all core scss files
            foreach (glob(self::$core_scss_folder_path) as $file)
            {
                $scss .= file_get_contents($file);
            }

            // Add together all scss files
            foreach (glob(self::$scss_folder_path) as $file)
            {
                $scss .= file_get_contents($file);
            }
    
            // Compile sass files
            $compiled_css = $compiler->compile($scss);

            // Add comment when file was last modified
            if (PRINT_COMPILE_DATE_CSS) {
                $compiled_css .= "\n\n\n/* Generated at: " . date(DATE_FORMAT . " " . TIME_FORMAT) . " */";
            }

            // Create css files from compiled sass
            file_put_contents(self::$compiled_css_folder_path . $theme_name . ".css", $compiled_css);
        }
    }
}