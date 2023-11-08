<?php defined("ACCESS") or exit("Access Denied");
/**
 * This content is rendered by language_menu block
 * Block::render("language_menu", ["xxxx" => "", "xxxx" => "", "xxxx" => ""]); 
 * 
 * Available variables:
 *  - $atts['xxxx']
 *  - $atts['xxxx']
 *  - $atts['xxxx']
 */

// Give default values to attributes
$atts = array_merge(array(
    'xxxx' => '',
    'xxxx' => '',
    'xxxx' => '',
), $atts);



ob_start();
include( __DIR__ . '/template.php' );
$output = ob_get_clean();
echo $output;