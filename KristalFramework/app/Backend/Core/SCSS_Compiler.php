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

        // Check if user has created any themes for css
        if (empty(glob("app/public/css/themes/*.scss")))
        {
            // No themes were found
            self::compileWithoutTheme($compiler);
        }
        else
        {
            // Themes found successfully
            self::compileWithTheme($compiler);
        }
    }


    private static function compileWithoutTheme($compiler)
    {
        $css = (PRINT_COMPILE_DATE_CSS) ? "/* Generated at: " . date(DATE_FORMAT . " " . TIME_FORMAT) . " */\n" : "";

        // Compile all scss into css
        foreach (glob("app/public/css/scss/*.scss") as $element)
        {
            $css .= $compiler->compile(file_get_contents($element));
        }

        // Delete old css files
        foreach (glob("app/public/css/*.css") as $old_css)
        {
            if (file_exists($old_css))
            {
                unlink($old_css);
            }
        }

        // Write compiled scss to css file
        $filename = (DEFAULT_THEME) ? DEFAULT_THEME : "main";
        file_put_contents("app/public/css/" . $filename . ".css", $css);
    }


    private static function compileWithTheme($compiler)
    {
        // Delete old css files
        foreach (glob("app/public/css/*.css") as $old_css)
        {
            if (file_exists($old_css))
            {
                unlink($old_css);
            }
        }

        // Create css file for every theme
        foreach (glob("app/public/css/themes/*.scss") as $theme)
        {
            $theme_name = str_replace(".scss", "", basename($theme));
            $variables = file_get_contents($theme);
            $css = (PRINT_COMPILE_DATE_CSS) ? "/* Generated at: " . date(DATE_FORMAT . " " . TIME_FORMAT) . " */\n" : "";

            // Compile all scss
            foreach (glob("app/public/css/scss/*.scss") as $element)
            {
                $css .= $compiler->compile($variables . file_get_contents($element));
            }

            // Write compiled scss to css file named by the theme
            file_put_contents("app/public/css/" . $theme_name . ".css", $css);
        }
    }
}