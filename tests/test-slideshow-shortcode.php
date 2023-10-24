<?php
/**
 * Class SlideshowShortcodeTest
 *
 * @package Slideshow
 */

/**
 *  SlideshowShortcodeTest.
 */
class SlideshowShortcodeTest extends WP_UnitTestCase {    
    /**
     * setUp
     *
     */
    protected function setUp()
    {
        parent::setUp();

        $this->class_instance = new IH_Slideshow();
    }
    
    public function test_shortcode_output() {
     
        $shortcode_output = trim( preg_replace('/\s+/', ' ', do_shortcode('[myslideshow]') ) ); 

        $shortcode_output = preg_replace('/\>\s+\</m', '><', $shortcode_output  );
  
        $expected_output = '<div class="bxslider"></div>';
 
        $this->assertEquals($expected_output, $shortcode_output);
    }
}
