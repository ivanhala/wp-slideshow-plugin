<?php
if ( ! defined( 'ABSPATH' ) ) exit;
   
$data =  get_option( 'slideshow_images', array() );
?>
<div id="slideshow_sortable_container">
    <ul id="slideshow_sortable">
    <?php
        foreach( $data as $url ){
            if( !filter_var( $url, FILTER_VALIDATE_URL ) ){
                continue;
            }
    ?>
            <li class="ui-state-default">     
                <div class="slideshow_thumbnail_centered">
                    <img src="<?php echo esc_url( $url ); ?>" />
                </div>
                <span class="dashicons dashicons-dismiss" onclick="jQuery(this).closest('li').remove();"></span>
            </li>
    <?php
        }
    ?>
    </ul>
    <p><?php echo __( 'Drag and drop images to change the order.', 'slideshow' ); ?></p>
</div>
<p>
    <input type="button" id="slideshow_add_image" class="button" value="Add images">
</p>