<?php 
/**
 * Plugin Name: Gutenberg Google Map
 * Description: Insert Goole Map to your post through the gutenberg.
 * Version: 1.0.0
 * Author: Govind Kumar
 * Author URI: http://emgk.github.io
 * Text-Domain: gutenberg-map
 */

// Exit if not defined.
defined('ABSPATH') || exit;

/**
 * Class Gutenberg map.
 * 
 * @since 1.0.0
 */
class Gutenberg_Map{
    
    /**
     * Constructor function for the Gutenberg map.
     * 
     * @since 1.0.0
     */
    public function __construct(){
        add_action('enqueue_block_editor_assets', array($this, 'register_assets_for_gutenberg_map'));
        add_action('wp_enqueue_scripts', array($this, 'register_assets_for_gutenberg_map'));
    }

    /**
     * Register the Gutenberg Map block.
     * 
     * @since 1.0.0
     */
    public function register_assets_for_gutenberg_map(){

        // Register gutenberg map block.
        wp_enqueue_script(
            'gutenberg-map-block',
            plugins_url('assets/blocks/gutenberg-map.js',__FILE__),
            array('wp-element','wp-blocks','wp-i18n', 'wp-components', 'wp-editor'),
		    filemtime( plugin_dir_path( __FILE__ ) . 'assets/blocks/gutenberg-map.js' )
        );

        // Register gutenberg map block.
        wp_enqueue_style(
            'gutenberg-map-block',
            plugins_url('assets/css/style.css',__FILE__)
        );

    } 
}

new Gutenberg_Map();
