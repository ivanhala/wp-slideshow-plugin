<?php
if ( ! defined( 'ABSPATH' ) ) exit;
?>

<div class="wrap">
    <h2><?php esc_html__( 'Slide Show Settings', 'slideshow' ); ?></h2>
        <?php
            settings_fields('slide-show-plugin-settings-group');
            do_settings_sections('slide-show-plugin-settings');
        ?>
        <input type="button" id="slideshow_save_settings" class="button button-primary" value="<?php echo esc_attr( __( 'Save images', 'slideshow' ) ) ?>">
</div>