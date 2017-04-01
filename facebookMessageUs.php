<?php
/**
 * Plugin Name: Message US on Facebook
 * Plugin URI: http://example.com/
 * Description: A brief description about your plugin.
 * Version: 1.0 or whatever version of the plugin (pretty self explanatory)
 * Author: Bamoo
 * Author URI: Author's website
 * License: A "Slug" license name e.g. GPL12
 */


//Register JS
function bamoo_fb_message_us_scripts()
{
    // Register the script like this for a plugin:
    wp_register_script('custom-script', plugins_url('/bamoo-fb-message-us.js', __FILE__));

    // For either a plugin or a theme, you can then enqueue the script:
    wp_enqueue_script('custom-script');
}
add_action('wp_enqueue_scripts', 'bamoo_fb_message_us_scripts');

//Register CSS
function bamoo_fb_message_us_styles()
{
    // Register the style like this for a plugin:
    wp_register_style( 'custom-style', plugins_url( '/bamoo-fb-message-us.css', __FILE__ ), array(), '20170401', 'all' );


    // For either a plugin or a theme, you can then enqueue the style:
    wp_enqueue_style( 'custom-style' );
}
add_action( 'wp_enqueue_scripts', 'bamoo_fb_message_us_styles');




function bamoo_show_message_us_view()
{

    $options = get_option( 'bamoo_fb_settings' );


    echo "<div class='bamoo_fb_message_us'><div class='fb-messengermessageus' messenger_app_id='" . $options['bamoo_fb_messenger_app_id'] . "' page_id='" . $options['bamoo_fb_page_id'] . "' color='blue' size='xlarge'></div> </div>";



}

add_action('wp_head', 'bamoo_show_message_us_view');



/* ------------------------------------------------------------------------ *
 * Setting Registration
 * ------------------------------------------------------------------------ */

add_action( 'admin_menu', 'bamoo_fb_add_admin_menu' );
add_action( 'admin_init', 'bamoo_fb_settings_init' );


function bamoo_fb_add_admin_menu(  ) {

    add_options_page( 'Message US on Facebook', 'Message US on Facebook', 'manage_options', 'message_us_on_facebook', 'bamoo_fb_options_page' );

}


function bamoo_fb_settings_init(  ) {

    register_setting( 'pluginPage', 'bamoo_fb_settings' );

    add_settings_section(
        'bamoo_fb_pluginPage_section',
        __( 'Your section description', 'wordpress' ),
        'bamoo_fb_settings_section_callback',
        'pluginPage'
    );


    //The Settings fields
    add_settings_field(
        'bamoo_fb_page_id',
        __( 'Facebook Page ID', 'wordpress' ),
        'bamoo_fb_page_id_render',
        'pluginPage',
        'bamoo_fb_pluginPage_section'
    );

    add_settings_field(
        'bamoo_fb_messenger_app_id',
        __( 'Messanger APP ID', 'wordpress' ),
        'bamoo_fb_messenger_app_id_render',
        'pluginPage',
        'bamoo_fb_pluginPage_section'
    );

    /*
    add_settings_field(
        'bamoo_fb_select_field_2',
        __( 'Settings field description', 'wordpress' ),
        'bamoo_fb_select_field_2_render',
        'pluginPage',
        'bamoo_fb_pluginPage_section'
    );
    */


}


function bamoo_fb_page_id_render(  ) {

    $options = get_option( 'bamoo_fb_settings' );
    ?>
    <input type='text' name='bamoo_fb_settings[bamoo_fb_page_id]' value='<?php echo $options['bamoo_fb_page_id']; ?>'>
    <?php

}


function bamoo_fb_messenger_app_id_render(  ) {

    $options = get_option( 'bamoo_fb_settings' );
    ?>
    <input type='text' name='bamoo_fb_settings[bamoo_fb_messenger_app_id]' value='<?php echo $options['bamoo_fb_messenger_app_id']; ?>'>
    <?php

}


function bamoo_fb_select_field_2_render(  ) {

    $options = get_option( 'bamoo_fb_settings' );
    ?>
    <select name='bamoo_fb_settings[bamoo_fb_select_field_2]'>
        <option value='1' <?php selected( $options['bamoo_fb_select_field_2'], 1 ); ?>>Option 1</option>
        <option value='2' <?php selected( $options['bamoo_fb_select_field_2'], 2 ); ?>>Option 2</option>
    </select>

    <?php

}


function bamoo_fb_settings_section_callback(  ) {

    echo __( 'This section description', 'wordpress' );

}


function bamoo_fb_options_page(  ) {

    ?>
    <form action='options.php' method='post'>

        <h2>Message US on Facebook</h2>

        <?php
        settings_fields( 'pluginPage' );
        do_settings_sections( 'pluginPage' );
        submit_button();
        ?>

    </form>
    <?php

}

