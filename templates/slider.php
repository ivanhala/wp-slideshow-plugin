<?php
if ( ! defined( 'ABSPATH' ) ) exit;
$data =  get_option( 'slideshow_images', array() );
?>
<div class="bxslider">
<?php
    foreach( $data as $url ){
        if( !filter_var( $url, FILTER_VALIDATE_URL ) ){
            continue;
        }
?>
        <div>
            <img src="<?php echo esc_url( $url ); ?>" />
        </div>
<?php
    }
?>
</div>

 