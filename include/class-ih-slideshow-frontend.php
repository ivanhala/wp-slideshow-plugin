<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Slideshow frontend class
 *
 * @version 1.0 
 * @since   1.0 
 */
class IH_Slideshow_Frontend
{
    /**
     * Front-end classs constructor
     */
    public function __construct() {
        add_shortcode( 'myslideshow', array( $this, 'myslideshow_shortcode' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

    }
      
    /**
     * [myslideshow] shortcode function  
     * 
     * @return string
     */
    public function myslideshow_shortcode(){
        wp_enqueue_script('bxslider');
        wp_enqueue_script('slideshow');
        wp_enqueue_style('bxslider');

        return IH_Render::render( 'slider' );
        
    }
      
    /**
     * Load front-end scripts
     * @return void
     */
    public function enqueue_scripts(){
        wp_register_script( 'bxslider', IH_Slideshow::get_plugin_url() . '/public/jquery.bxslider.js', array( 'jquery' ), IH_Slideshow::PLUGIN_VERSION );
        wp_register_script( 'slideshow', IH_Slideshow::get_plugin_url() . '/public/slideshow_frontend.js', array( 'bxslider' ), IH_Slideshow::PLUGIN_VERSION );
        wp_register_style( 'bxslider', IH_Slideshow::get_plugin_url() . '/public/jquery.bxslider.css', array(),  IH_Slideshow::PLUGIN_VERSION );

    }  
}