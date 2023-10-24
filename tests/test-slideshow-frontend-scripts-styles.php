<?php
/**
 * Class SlideshowFrotendScripsStylesTest
 *
 * @package Slideshow
 */

/**
 *  SlideshowFrotendScripsStylesTest.
 */
class SlideshowFrotendScripsStylesTest extends WP_UnitTestCase {
    public function setUp(): void {
        parent::setUp();
        $this->class_instance = new IH_Slideshow();
        do_action('wp_enqueue_scripts');
        do_shortcode('[myslideshow]');
    }
    
    public function test_scripts() {
        // bxslider script must be registered
        $this->assertTrue( wp_script_is( 'bxslider', 'registered' ) );

        // slideshow script must be registered
        $this->assertTrue( wp_script_is( 'slideshow', 'registered' ) );

        // bxslider style must be registered
        $this->assertTrue( wp_style_is( 'bxslider', 'registered' ) );
        
        // bxslider script must be enqueued
        $this->assertTrue( wp_script_is( 'bxslider' ) );

        // slideshow script must be enqueued
        $this->assertTrue( wp_script_is( 'slideshow' ) );

        // bxslider style must be enqueued
        $this->assertTrue( wp_style_is( 'bxslider' ) );
      
    }
}
