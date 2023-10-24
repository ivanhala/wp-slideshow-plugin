<?php
/**
* Plugin Name: Slideshow plugin
* Description: Sample Programming Challenges
* Version: 1.0
* Author: Ivan Halaka
* Author URI: mailto:ivan@webba-booking.com
*/
if ( ! defined( 'ABSPATH' ) ) exit;

include 'include/class-ih-render.php';
include 'include/class-ih-slideshow-admin.php';
include 'include/class-ih-slideshow-frontend.php';

class IH_Slideshow 
{
    public $admin, $frontend;
    const PLUGIN_PATH = __DIR__;
    const PLUGIN_VERSION = '1.0';
  
    /**
     * Initializes Admin or Front-end
     * @return void
     */
    public function __construct() {   
        if( is_admin() || wp_is_json_request() ){
            $this->admin = new IH_Slideshow_Admin();
        } else {
            $this->frontend = new IH_Slideshow_Frontend();
        }
        add_action( 'init', array( $this, 'load_text_domain' ) );
    }
        
    /**
     * Load test domain
     *
     * @return void
     */
    public function load_text_domain(){
        load_plugin_textdomain( 'slideshow' );

    }

    /**
     * returns plugin URL
     * @return string
     */
    public static function get_plugin_url() {
        return plugins_url( plugin_basename( self::PLUGIN_PATH ) );      

    }

 
  
} 

new IH_Slideshow();
 