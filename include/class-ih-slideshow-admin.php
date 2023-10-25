<?php
/**
 * Slideshow admin class
 *
 * @version 1.0 
 * @since   1.0 
 */
if ( ! defined( 'ABSPATH' ) ) exit;

class IH_Slideshow_Admin
{
    /**
     * Plugins classs constructor
     */
    public function __construct() {
        add_action('admin_menu', array( $this, 'slideshow_plugin_menu' ) );
        add_action('admin_init', array( $this, 'slideshow_plugin_settings_init' ) );
        add_action('admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        add_action( 'rest_api_init', function () {
            register_rest_route( 'slideshow/v1', '/save-settings/', [
                'methods' => 'POST',
                'callback' =>  array( $this, 'save_settings' ),
                'permission_callback' => array( $this, 'save_settings_permission' )
            ] );
        } );
    }
      
    /**
     * Register and enqueue script and style used in the admin taking into account current screen.
     *
     * @return void
     */
    public function enqueue_scripts() {
        $screen = get_current_screen();
        $screen_id = $screen ? $screen->id : '';
   
        $translation_array = array(
            'nonce' => wp_create_nonce( 'wp_rest' ),
            'rest_url' =>  esc_url_raw( parse_url( rest_url(), PHP_URL_PATH ) ),
            'saving_images' => __( 'Saving images...', 'slideshow' ),
        );

        wp_register_script( 'slideshow-admin',  IH_Slideshow::get_plugin_url() . '/public/slideshow_admin.js', array( 'jquery', 'jquery-ui-sortable'  ), IH_Slideshow::PLUGIN_VERSION );
        wp_register_style( 'slideshow-admin', IH_Slideshow::get_plugin_url() . '/public/slideshow_admin.css', array(),  IH_Slideshow::PLUGIN_VERSION );
		
        if( $screen_id == 'toplevel_page_slide-show-plugin-settings' ){
            wp_enqueue_script( 'slideshow-admin' );
            wp_enqueue_style( 'slideshow-admin' );
            wp_localize_script( 'slideshow-admin', 'slideshowl10n', $translation_array );
            wp_enqueue_media();
        }
    }
        
    /**
     * Adds menu WordPress admin menu page
     *
     * @return void
     */
    public function slideshow_plugin_menu() {
        add_menu_page( __( 'Slideshow Plugin Settings', 'slideshow' ) , __( 'Slideshow Settings', 'slideshow' ), 'manage_options', 'slide-show-plugin-settings', array( $this, 'slideshow_plugin_settings_page' ) );
    }
    
    /**
     * Renders slideshow settings page content.
     * 
     * @return string
     */
    function slideshow_plugin_settings_page() {
        echo IH_Render::render( 'settings_page' );
    }
    
    /**
     * Initialize settings.
     *
     * @return void
     */
    function slideshow_plugin_settings_init() {
        register_setting('slide-show-plugin-settings-group', 'slideshow_images', array( $this, 'slideshow_images_validate' ) );
        add_settings_section('slide-show-plugin-settings-section', __( 'Slideshow Settings', 'slideshow' ), array( $this, 'slideshow_plugin_section_text' ), 'slide-show-plugin-settings' );
        add_settings_field('slide-show-plugin-images', 'Images', array( $this, 'slideshow_images_render' ), 'slide-show-plugin-settings', 'slide-show-plugin-settings-section' );
    }
    
    /**
     * Renders settings section description.
     *
     * @return void
     */
    function slideshow_plugin_section_text(){
        echo __( 'Manage images to be shown in the slideshow.', 'slideshow' );
    }
    
    /**
     * Renders 'slideshow_images' option field.
     *
     * @return void
     */
    function slideshow_images_render() {
       echo IH_Render::render('images_field');
    }
        
    /**
     * validate_urls
     *
     * @param  mixed $input
     * @return array
     */
    public function validate_urls( $input ){
        if( !is_array( $input ) ){
            return array();
        }
        foreach( $input as $key => $url ){
            if( !filter_var( $url, FILTER_VALIDATE_URL ) ){
                unset( $urls[$key] );
            }
        }  
        return $input;
    }

    /**
     * Validate input.
     *
     * @param  mixed $input
     * @return void
     */
    public function slideshow_images_validate( $input ){       
        return $this->validate_urls( $input );

    }
    
    /**
     * Save image URLs
     *
     * @param  WP_REST_Request $request
     * @return WP_REST_Response
     */
    public function save_settings( $request ){
        $urls = $request['urls'];
        if( !is_array( $urls ) ){
            return new \WP_REST_Response( array ( 'message' => __( 'Error: passed URLs are wrong.', 'slideshow' ) ), 400 );
        }
        foreach( $urls as $key => $url ){
            if( !filter_var( $url, FILTER_VALIDATE_URL ) ){
                unset( $urls[$key] );
            }
        }         
        update_option( 'slideshow_images', $urls );
        return new \WP_REST_Response( array ( 'message' => __( 'Images saved succesfully!', 'slideshow' ) ), 200 );
    }
    
    /**
     * Saving URLs permission check.
     *
     * @return void
     */
    public function save_settings_permission(){
          return current_user_can( 'manage_options' );
            
    }
}