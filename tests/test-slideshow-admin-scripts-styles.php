<?php
/**
 * Class SlideshowAdminScripsStylesTest
 *
 * @package Slideshow
 */

/**
 *  SlideshowAdminScripsStylesTest.
 */
class SlideshowAdminScripsStylesTest extends WP_UnitTestCase {
    public function setUp(): void {
        parent::setUp(); 
        set_current_screen( 'dashboard' );    
        $this->class_instance = new IH_Slideshow();
    }
    
    public function test_scripts() {
        do_action('admin_enqueue_scripts');
        // script must be registered  
        $this->assertTrue(  wp_script_is( 'slideshow-admin', 'registered' ) );
        // style must be registered 
        $this->assertTrue(  wp_style_is( 'slideshow-admin', 'registered' ) );

        do_action('admin_enqueue_scripts');
        // script is not enqueued becasue we are on the 'dashboard' screen
        $this->assertFalse(  wp_script_is( 'slideshow-admin' ) );
        // style is not enqueued becasue we are on the 'dashboard' screen
        $this->assertFalse(  wp_style_is( 'slideshow-admin' ) );

        set_current_screen( 'toplevel_page_slide-show-plugin-settings' );   
        do_action('admin_enqueue_scripts');
        // script is enqueued becasue we are the plugin settings screen
        $this->assertTrue(  wp_script_is( 'slideshow-admin' ) );
        // style is enqueued becasue we are the plugin settings screen
        $this->assertTrue(  wp_style_is( 'slideshow-admin' ) );
    }
}
