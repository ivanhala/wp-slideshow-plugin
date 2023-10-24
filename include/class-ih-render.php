<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Slideshow template loader (renderer)
 *
 * @version 1.0 
 * @since   1.0 
 */
class IH_Render {
    /**
     * Render template
     *
     * @param  string $template
     * @return string
     */
    public static function render( string $template ) {
        $file_name =  IH_Slideshow::PLUGIN_PATH . DIRECTORY_SEPARATOR.  'templates' . DIRECTORY_SEPARATOR . $template . '.php';  
        ob_start();
        if( file_exists( $file_name ) ){
            include $file_name;
        }
        return ob_get_clean();        
    }
}