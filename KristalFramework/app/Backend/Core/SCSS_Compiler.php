<?php namespace Backend\Core;
defined("ACCESS") or exit("Access Denied");

use ScssPhp\ScssPhp\Compiler;


final class SCSS_Compiler
{
    public static function compile()
    {
        $compiler = new Compiler();

        // Select formatter
        switch (strtolower(COMPILED_CSS_TYPE))
        {
            case "compressed": $compiler->setFormatter("ScssPhp\ScssPhp\Formatter\Compressed"); break;
            case "compact": $compiler->setFormatter("ScssPhp\ScssPhp\Formatter\Compact"); break;
            case "expanded": $compiler->setFormatter("ScssPhp\ScssPhp\Formatter\Expanded"); break;
            case "nested": $compiler->setFormatter("ScssPhp\ScssPhp\Formatter\Nested"); break;
            default: $compiler->setFormatter("ScssPhp\ScssPhp\Formatter\Compressed"); break;
        }

        if (empty(glob("app/public/css/themes/*.scss")))
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
        $compiled_file_mtime = file_exists("app/public/css/" . DEFAULT_THEME . ".css") ? filemtime("app/public/css/" . DEFAULT_THEME . ".css") : 0;

        foreach (glob("app/public/css/scss/*.scss") as $element)
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
        foreach (glob("app/public/css/themes/*.scss") as $theme)
        {
            $theme_name = str_replace(".scss", "", basename($theme));

            if (filemtime($theme) > filemtime("app/public/css/" . $theme_name . ".css"))
            {
                return true;
            }

            foreach (glob("app/public/css/scss/*.scss") as $scss_file)
            {
                if (filemtime($scss_file) > filemtime("app/public/css/" . $theme_name . ".css"))
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

        // Add together all scss files
        foreach (glob("app/public/css/scss/*.scss") as $file)
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
        file_put_contents("app/public/css/" . DEFAULT_THEME . ".css", $compiled_css);
    }

    
    private static function compileWithTheme($compiler)
    {
        $scss = "";
        
        // Go through all themes and generate their css
        foreach (glob("app/public/css/themes/*.scss") as $theme)
        {
            // Get theme name
            $theme_name = str_replace(".scss", "", basename($theme));

            // Add theme variables
            $scss .= file_get_contents($theme);

            // Add together all scss files
            foreach (glob("app/public/css/scss/*.scss") as $file)
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
            file_put_contents("app/public/css/" . $theme_name . ".css", $compiled_css);
        }
    }
}